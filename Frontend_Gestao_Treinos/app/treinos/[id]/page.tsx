"use client"

import { useState } from "react"
import { AppShell } from "@/components/app-shell"
import { Button } from "@/components/ui/button"
import { 
  ArrowLeft, 
  Clock, 
  Flame, 
  Play, 
  CheckCircle2,
  Circle,
  ChevronDown,
  ChevronUp,
  Info
} from "lucide-react"
import Link from "next/link"
import { cn } from "@/lib/utils"

// Mock data - será substituído pela API Laravel
const workoutDetail = {
  id: "peito-triceps",
  title: "Treino de Peito e Tríceps",
  category: "musculacao",
  duration: 45,
  calories: 320,
  difficulty: "intermediario",
  description: "Treino focado no desenvolvimento do peitoral e tríceps. Ideal para quem busca hipertrofia e força na parte superior do corpo.",
  exercises: [
    {
      id: "1",
      name: "Supino Reto",
      sets: 4,
      reps: "10-12",
      rest: 90,
      muscleGroup: "Peito",
      instructions: "Deite no banco, segure a barra com pegada média. Desça até o peito e empurre até estender os braços.",
    },
    {
      id: "2",
      name: "Supino Inclinado com Halteres",
      sets: 3,
      reps: "12",
      rest: 60,
      muscleGroup: "Peito Superior",
      instructions: "Banco inclinado a 30-45 graus. Movimento controlado de subida e descida.",
    },
    {
      id: "3",
      name: "Crucifixo",
      sets: 3,
      reps: "15",
      rest: 60,
      muscleGroup: "Peito",
      instructions: "Braços levemente flexionados, abra e feche os braços em arco.",
    },
    {
      id: "4",
      name: "Flexão de Braço",
      sets: 3,
      reps: "Até falha",
      rest: 60,
      muscleGroup: "Peito",
      instructions: "Mantenha o core ativado, desça até o peito quase tocar o chão.",
    },
    {
      id: "5",
      name: "Tríceps Pulley",
      sets: 4,
      reps: "12-15",
      rest: 60,
      muscleGroup: "Tríceps",
      instructions: "Mantenha os cotovelos junto ao corpo, estenda completamente.",
    },
    {
      id: "6",
      name: "Tríceps Francês",
      sets: 3,
      reps: "12",
      rest: 60,
      muscleGroup: "Tríceps",
      instructions: "Halteres acima da cabeça, flexione os cotovelos e estenda.",
    },
    {
      id: "7",
      name: "Mergulho no Banco",
      sets: 3,
      reps: "15",
      rest: 60,
      muscleGroup: "Tríceps",
      instructions: "Mãos apoiadas no banco atrás, desça flexionando os cotovelos.",
    },
    {
      id: "8",
      name: "Flexão Diamante",
      sets: 2,
      reps: "Até falha",
      rest: 60,
      muscleGroup: "Tríceps",
      instructions: "Mãos juntas formando um diamante, foque no tríceps.",
    },
  ],
}

export default function WorkoutDetailPage() {
  const [completedExercises, setCompletedExercises] = useState<string[]>([])
  const [expandedExercise, setExpandedExercise] = useState<string | null>(null)

  const toggleExercise = (id: string) => {
    setCompletedExercises((prev) =>
      prev.includes(id) ? prev.filter((e) => e !== id) : [...prev, id]
    )
  }

  const toggleExpand = (id: string) => {
    setExpandedExercise(expandedExercise === id ? null : id)
  }

  const progress = (completedExercises.length / workoutDetail.exercises.length) * 100

  return (
    <AppShell>
      <div className="p-4 md:p-8 space-y-6 max-w-3xl mx-auto">
        {/* Back Button */}
        <Link 
          href="/treinos" 
          className="inline-flex items-center gap-2 text-muted-foreground hover:text-foreground transition-colors"
        >
          <ArrowLeft className="h-4 w-4" />
          Voltar aos treinos
        </Link>

        {/* Header */}
        <header className="space-y-4">
          <div className="flex items-center gap-2">
            <span className="rounded-md bg-primary/20 px-2 py-1 text-xs font-medium text-primary">
              Musculação
            </span>
            <span className="rounded-md bg-yellow-500/20 px-2 py-1 text-xs font-medium text-yellow-500">
              Intermediário
            </span>
          </div>
          
          <h1 className="text-2xl md:text-3xl font-bold tracking-tight">
            {workoutDetail.title}
          </h1>
          
          <p className="text-muted-foreground">
            {workoutDetail.description}
          </p>

          <div className="flex items-center gap-6 text-sm">
            <span className="flex items-center gap-2">
              <Clock className="h-5 w-5 text-muted-foreground" />
              {workoutDetail.duration} minutos
            </span>
            <span className="flex items-center gap-2">
              <Flame className="h-5 w-5 text-primary" />
              {workoutDetail.calories} kcal
            </span>
          </div>
        </header>

        {/* Progress */}
        <div className="space-y-2">
          <div className="flex items-center justify-between text-sm">
            <span className="text-muted-foreground">Progresso</span>
            <span className="font-medium">
              {completedExercises.length}/{workoutDetail.exercises.length} exercícios
            </span>
          </div>
          <div className="h-2 rounded-full bg-secondary overflow-hidden">
            <div 
              className="h-full bg-primary transition-all duration-300"
              style={{ width: `${progress}%` }}
            />
          </div>
        </div>

        {/* Start Button */}
        <Button className="w-full gap-2" size="lg">
          <Play className="h-5 w-5" />
          Iniciar Treino
        </Button>

        {/* Exercises List */}
        <section className="space-y-3">
          <h2 className="text-lg font-semibold">Exercícios</h2>
          
          <div className="space-y-2">
            {workoutDetail.exercises.map((exercise, index) => {
              const isCompleted = completedExercises.includes(exercise.id)
              const isExpanded = expandedExercise === exercise.id
              
              return (
                <div
                  key={exercise.id}
                  className={cn(
                    "rounded-xl border transition-all",
                    isCompleted 
                      ? "bg-primary/5 border-primary/30" 
                      : "bg-card border-border"
                  )}
                >
                  <div className="flex items-center gap-3 p-4">
                    <button
                      onClick={() => toggleExercise(exercise.id)}
                      className={cn(
                        "flex h-8 w-8 shrink-0 items-center justify-center rounded-full transition-colors",
                        isCompleted 
                          ? "bg-primary text-primary-foreground" 
                          : "bg-secondary text-muted-foreground hover:text-foreground"
                      )}
                    >
                      {isCompleted ? (
                        <CheckCircle2 className="h-5 w-5" />
                      ) : (
                        <span className="text-sm font-medium">{index + 1}</span>
                      )}
                    </button>
                    
                    <div className="flex-1 min-w-0">
                      <h3 className={cn(
                        "font-medium truncate",
                        isCompleted && "line-through text-muted-foreground"
                      )}>
                        {exercise.name}
                      </h3>
                      <p className="text-sm text-muted-foreground">
                        {exercise.sets} séries × {exercise.reps} reps • {exercise.rest}s descanso
                      </p>
                    </div>
                    
                    <button
                      onClick={() => toggleExpand(exercise.id)}
                      className="p-2 text-muted-foreground hover:text-foreground transition-colors"
                    >
                      {isExpanded ? (
                        <ChevronUp className="h-5 w-5" />
                      ) : (
                        <ChevronDown className="h-5 w-5" />
                      )}
                    </button>
                  </div>
                  
                  {isExpanded && (
                    <div className="px-4 pb-4 pt-0">
                      <div className="rounded-lg bg-secondary/50 p-3 space-y-2">
                        <div className="flex items-center gap-2 text-sm">
                          <Info className="h-4 w-4 text-primary" />
                          <span className="font-medium">Instruções</span>
                        </div>
                        <p className="text-sm text-muted-foreground">
                          {exercise.instructions}
                        </p>
                        <div className="text-xs text-muted-foreground">
                          Grupo muscular: {exercise.muscleGroup}
                        </div>
                      </div>
                    </div>
                  )}
                </div>
              )
            })}
          </div>
        </section>
      </div>
    </AppShell>
  )
}
