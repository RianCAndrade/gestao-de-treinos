/**
 * Serviço de API para conectar com o backend Laravel
 * 
 * Configure a variável de ambiente NEXT_PUBLIC_API_URL com a URL da sua API Laravel
 * Exemplo: NEXT_PUBLIC_API_URL=https://sua-api.com/api
 */

const API_URL = process.env.NEXT_PUBLIC_API_URL || "http://localhost:8000/api"

interface ApiOptions {
  method?: "GET" | "POST" | "PUT" | "PATCH" | "DELETE"
  body?: unknown
  headers?: Record<string, string>
}

class ApiService {
  private token: string | null = null

  setToken(token: string) {
    this.token = token
    if (typeof window !== "undefined") {
      localStorage.setItem("auth_token", token)
    }
  }

  getToken(): string | null {
    if (this.token) return this.token
    if (typeof window !== "undefined") {
      return localStorage.getItem("auth_token")
    }
    return null
  }

  clearToken() {
    this.token = null
    if (typeof window !== "undefined") {
      localStorage.removeItem("auth_token")
    }
  }

  private async request<T>(endpoint: string, options: ApiOptions = {}): Promise<T> {
    const { method = "GET", body, headers = {} } = options
    
    const token = this.getToken()
    
    const config: RequestInit = {
      method,
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
        ...(token && { Authorization: `Bearer ${token}` }),
        ...headers,
      },
    }

    if (body) {
      config.body = JSON.stringify(body)
    }

    const response = await fetch(`${API_URL}${endpoint}`, config)

    if (!response.ok) {
      const error = await response.json().catch(() => ({ message: "Erro desconhecido" }))
      throw new Error(error.message || `Erro ${response.status}`)
    }

    return response.json()
  }

  // ============ AUTENTICAÇÃO ============
  
  async login(email: string, password: string) {
    const data = await this.request<{ token: string; user: User }>("/auth/login", {
      method: "POST",
      body: { email, password },
    })
    this.setToken(data.token)
    return data
  }

  async register(userData: RegisterData) {
    const data = await this.request<{ token: string; user: User }>("/auth/register", {
      method: "POST",
      body: userData,
    })
    this.setToken(data.token)
    return data
  }

  async logout() {
    await this.request("/auth/logout", { method: "POST" })
    this.clearToken()
  }

  async getProfile() {
    return this.request<User>("/user/profile")
  }

  async updateProfile(data: Partial<User>) {
    return this.request<User>("/user/profile", {
      method: "PUT",
      body: data,
    })
  }

  // ============ TREINOS ============

  async getWorkouts(filters?: WorkoutFilters) {
    const params = new URLSearchParams()
    if (filters?.category) params.append("category", filters.category)
    if (filters?.difficulty) params.append("difficulty", filters.difficulty)
    if (filters?.search) params.append("search", filters.search)
    
    const query = params.toString() ? `?${params}` : ""
    return this.request<Workout[]>(`/workouts${query}`)
  }

  async getWorkout(id: string) {
    return this.request<WorkoutDetail>(`/workouts/${id}`)
  }

  async startWorkout(id: string) {
    return this.request<WorkoutSession>(`/workouts/${id}/start`, { method: "POST" })
  }

  async completeWorkout(sessionId: string, data: WorkoutCompletionData) {
    return this.request(`/workout-sessions/${sessionId}/complete`, {
      method: "POST",
      body: data,
    })
  }

  // ============ EXERCÍCIOS ============

  async getExercises(filters?: ExerciseFilters) {
    const params = new URLSearchParams()
    if (filters?.muscleGroup) params.append("muscle_group", filters.muscleGroup)
    if (filters?.equipment) params.append("equipment", filters.equipment)
    if (filters?.search) params.append("search", filters.search)
    
    const query = params.toString() ? `?${params}` : ""
    return this.request<Exercise[]>(`/exercises${query}`)
  }

  async getExercise(id: string) {
    return this.request<Exercise>(`/exercises/${id}`)
  }

  // ============ CHAT IA ============

  async sendChatMessage(message: string) {
    return this.request<ChatResponse>("/chat", {
      method: "POST",
      body: { message },
    })
  }

  async getChatHistory() {
    return this.request<ChatMessage[]>("/chat/history")
  }

  // ============ ESTATÍSTICAS ============

  async getStats() {
    return this.request<UserStats>("/user/stats")
  }

  async getWeeklyProgress() {
    return this.request<WeeklyProgress>("/user/weekly-progress")
  }

  // ============ CONQUISTAS ============

  async getAchievements() {
    return this.request<Achievement[]>("/achievements")
  }
}

// Tipos TypeScript para a API
export interface User {
  id: string
  name: string
  email: string
  phone?: string
  birth_date?: string
  height?: number
  weight?: number
  goal?: "hipertrofia" | "emagrecimento" | "condicionamento" | "forca"
  level?: "iniciante" | "intermediario" | "avancado"
  avatar_url?: string
  created_at: string
}

export interface RegisterData {
  name: string
  email: string
  password: string
  password_confirmation: string
}

export interface Workout {
  id: string
  title: string
  category: "calistenia" | "musculacao" | "cardio" | "hiit" | "funcional"
  duration: number
  calories: number
  exercises_count: number
  difficulty: "iniciante" | "intermediario" | "avancado"
  image_url?: string
}

export interface WorkoutDetail extends Workout {
  description: string
  exercises: WorkoutExercise[]
}

export interface WorkoutExercise {
  id: string
  name: string
  sets: number
  reps: string
  rest: number
  muscle_group: string
  instructions: string
  video_url?: string
  image_url?: string
}

export interface WorkoutFilters {
  category?: string
  difficulty?: string
  search?: string
}

export interface WorkoutSession {
  id: string
  workout_id: string
  started_at: string
}

export interface WorkoutCompletionData {
  completed_exercises: string[]
  duration_minutes: number
  notes?: string
}

export interface Exercise {
  id: string
  name: string
  description: string
  muscle_group: string
  equipment?: string
  difficulty: string
  instructions: string
  video_url?: string
  image_url?: string
}

export interface ExerciseFilters {
  muscleGroup?: string
  equipment?: string
  search?: string
}

export interface ChatMessage {
  id: string
  role: "user" | "assistant"
  content: string
  created_at: string
}

export interface ChatResponse {
  message: ChatMessage
}

export interface UserStats {
  total_workouts: number
  streak: number
  total_minutes: number
  total_calories: number
  weekly_goal: number
  weekly_completed: number
}

export interface WeeklyProgress {
  days: {
    date: string
    workouts: number
    minutes: number
    calories: number
  }[]
}

export interface Achievement {
  id: string
  title: string
  description: string
  icon: string
  unlocked: boolean
  unlocked_at?: string
}

// Exporta instância única do serviço
export const api = new ApiService()
