"use client"

import { useState } from "react"
import { AppShell } from "@/components/app-shell"
import { WorkoutCard } from "@/components/workout-card"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Search, Filter, Dumbbell, Users, Zap, Heart, Target } from "lucide-react"
import { cn } from "@/lib/utils"

// Mock data - será substituído pela API Laravel
const categories = [
  { id: "todos", label: "Todos", icon: Target },
  { id: "musculacao", label: "Musculação", icon: Dumbbell },
  { id: "calistenia", label: "Calistenia", icon: Users },
  { id: "hiit", label: "HIIT", icon: Zap },
  { id: "cardio", label: "Cardio", icon: Heart },
]

const allWorkouts = [
  {
    id: "peito-triceps",
    title: "Treino de Peito e Tríceps",
    category: "musculacao" as const,
    duration: 45,
    calories: 320,
    exercises: 8,
    difficulty: "intermediario" as const,
  },
  {
    id: "costas-biceps",
    title: "Treino de Costas e Bíceps",
    category: "musculacao" as const,
    duration: 50,
    calories: 350,
    exercises: 9,
    difficulty: "intermediario" as const,
  },
  {
    id: "pernas-gluteos",
    title: "Treino de Pernas e Glúteos",
    category: "musculacao" as const,
    duration: 55,
    calories: 400,
    exercises: 10,
    difficulty: "avancado" as const,
  },
  {
    id: "calistenia-iniciante",
    title: "Calistenia para Iniciantes",
    category: "calistenia" as const,
    duration: 30,
    calories: 200,
    exercises: 6,
    difficulty: "iniciante" as const,
  },
  {
    id: "calistenia-intermediario",
    title: "Calistenia Intermediário",
    category: "calistenia" as const,
    duration: 40,
    calories: 280,
    exercises: 8,
    difficulty: "intermediario" as const,
  },
  {
    id: "calistenia-avancado",
    title: "Calistenia Skills",
    category: "calistenia" as const,
    duration: 50,
    calories: 350,
    exercises: 7,
    difficulty: "avancado" as const,
  },
  {
    id: "hiit-queima-gordura",
    title: "HIIT Queima de Gordura",
    category: "hiit" as const,
    duration: 20,
    calories: 280,
    exercises: 10,
    difficulty: "avancado" as const,
  },
  {
    id: "hiit-iniciante",
    title: "HIIT para Iniciantes",
    category: "hiit" as const,
    duration: 15,
    calories: 180,
    exercises: 8,
    difficulty: "iniciante" as const,
  },
  {
    id: "cardio-leve",
    title: "Cardio Leve",
    category: "cardio" as const,
    duration: 30,
    calories: 220,
    exercises: 5,
    difficulty: "iniciante" as const,
  },
  {
    id: "cardio-intenso",
    title: "Cardio Intenso",
    category: "cardio" as const,
    duration: 40,
    calories: 380,
    exercises: 6,
    difficulty: "avancado" as const,
  },
]

export default function TreinosPage() {
  const [selectedCategory, setSelectedCategory] = useState("todos")
  const [searchQuery, setSearchQuery] = useState("")

  const filteredWorkouts = allWorkouts.filter((workout) => {
    const matchesCategory = selectedCategory === "todos" || workout.category === selectedCategory
    const matchesSearch = workout.title.toLowerCase().includes(searchQuery.toLowerCase())
    return matchesCategory && matchesSearch
  })

  return (
    <AppShell>
      <div className="p-4 md:p-8 space-y-6">
        {/* Header */}
        <header className="space-y-2">
          <h1 className="text-2xl md:text-3xl font-bold tracking-tight">Treinos</h1>
          <p className="text-muted-foreground">
            Escolha seu treino ideal entre nossas opções
          </p>
        </header>

        {/* Search and Filter */}
        <div className="flex gap-3">
          <div className="relative flex-1">
            <Search className="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground" />
            <Input
              placeholder="Buscar treinos..."
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              className="pl-10 bg-card border-border"
            />
          </div>
          <Button variant="outline" size="icon" className="shrink-0">
            <Filter className="h-4 w-4" />
          </Button>
        </div>

        {/* Categories */}
        <div className="flex gap-2 overflow-x-auto pb-2 scrollbar-hide">
          {categories.map((category) => {
            const isActive = selectedCategory === category.id
            return (
              <button
                key={category.id}
                onClick={() => setSelectedCategory(category.id)}
                className={cn(
                  "flex items-center gap-2 rounded-full px-4 py-2 text-sm font-medium whitespace-nowrap transition-all",
                  isActive
                    ? "bg-primary text-primary-foreground"
                    : "bg-card border border-border text-muted-foreground hover:text-foreground hover:border-primary/50"
                )}
              >
                <category.icon className="h-4 w-4" />
                {category.label}
              </button>
            )
          })}
        </div>

        {/* Workouts Grid */}
        <div className="grid gap-3 md:grid-cols-2 lg:grid-cols-3">
          {filteredWorkouts.map((workout) => (
            <WorkoutCard key={workout.id} {...workout} />
          ))}
        </div>

        {filteredWorkouts.length === 0 && (
          <div className="text-center py-12">
            <p className="text-muted-foreground">Nenhum treino encontrado</p>
          </div>
        )}
      </div>
    </AppShell>
  )
}
