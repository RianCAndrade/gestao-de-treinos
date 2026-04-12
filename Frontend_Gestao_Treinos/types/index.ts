// Re-exporta todos os tipos da API
export * from "@/lib/api"

// Tipos adicionais para uso no frontend

export interface NavItem {
  href: string
  label: string
  icon: React.ComponentType<{ className?: string }>
}

export interface StatsCardData {
  title: string
  value: string | number
  subtitle?: string
  trend?: {
    value: number
    positive: boolean
  }
}

export interface WorkoutCardData {
  id: string
  title: string
  category: "calistenia" | "musculacao" | "cardio" | "hiit" | "funcional"
  duration: number
  calories: number
  exercises: number
  difficulty: "iniciante" | "intermediario" | "avancado"
  imageUrl?: string
}

export type WorkoutCategory = 
  | "todos" 
  | "calistenia" 
  | "musculacao" 
  | "cardio" 
  | "hiit" 
  | "funcional"

export type DifficultyLevel = "iniciante" | "intermediario" | "avancado"

export type UserGoal = "hipertrofia" | "emagrecimento" | "condicionamento" | "forca"

export interface CategoryOption {
  id: WorkoutCategory
  label: string
  icon: React.ComponentType<{ className?: string }>
}

export interface SettingsState {
  notifications: boolean
  darkMode: boolean
  sound: boolean
  vibration: boolean
  workoutReminder: boolean
  weeklyReport: boolean
}
