"use client"

import { cn } from "@/lib/utils"
import { Clock, Flame, ChevronRight } from "lucide-react"
import Link from "next/link"

interface WorkoutCardProps {
  id: string
  title: string
  category: "calistenia" | "musculacao" | "cardio" | "hiit" | "funcional"
  duration: number
  calories: number
  exercises: number
  difficulty: "iniciante" | "intermediario" | "avancado"
  imageUrl?: string
  className?: string
}

const categoryLabels = {
  calistenia: "Calistenia",
  musculacao: "Musculação",
  cardio: "Cardio",
  hiit: "HIIT",
  funcional: "Funcional",
}

const difficultyColors = {
  iniciante: "bg-green-500/20 text-green-500",
  intermediario: "bg-yellow-500/20 text-yellow-500",
  avancado: "bg-primary/20 text-primary",
}

const difficultyLabels = {
  iniciante: "Iniciante",
  intermediario: "Intermediário",
  avancado: "Avançado",
}

export function WorkoutCard({
  id,
  title,
  category,
  duration,
  calories,
  exercises,
  difficulty,
  className,
}: WorkoutCardProps) {
  return (
    <Link
      href={`/treinos/${id}`}
      className={cn(
        "group block rounded-xl bg-card border border-border p-4 transition-all hover:border-primary/50 hover:bg-card/80",
        className
      )}
    >
      <div className="flex items-center justify-between">
        <div className="flex-1 space-y-2">
          <div className="flex items-center gap-2">
            <span className={cn(
              "rounded-md px-2 py-0.5 text-xs font-medium",
              difficultyColors[difficulty]
            )}>
              {difficultyLabels[difficulty]}
            </span>
            <span className="text-xs text-muted-foreground">
              {categoryLabels[category]}
            </span>
          </div>
          
          <h3 className="font-semibold text-foreground group-hover:text-primary transition-colors">
            {title}
          </h3>
          
          <div className="flex items-center gap-4 text-sm text-muted-foreground">
            <span className="flex items-center gap-1">
              <Clock className="h-4 w-4" />
              {duration} min
            </span>
            <span className="flex items-center gap-1">
              <Flame className="h-4 w-4 text-primary" />
              {calories} kcal
            </span>
            <span>{exercises} exercícios</span>
          </div>
        </div>
        
        <ChevronRight className="h-5 w-5 text-muted-foreground group-hover:text-primary transition-colors" />
      </div>
    </Link>
  )
}
