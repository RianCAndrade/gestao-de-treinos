"use client"

import { AppShell } from "@/components/app-shell"
import { StatsCard } from "@/components/stats-card"
import { WorkoutCard } from "@/components/workout-card"
import { Button } from "@/components/ui/button"
import { 
  Flame, 
  Target, 
  Clock, 
  TrendingUp,
  ChevronRight,
  Play,
  Sparkles
} from "lucide-react"
import Link from "next/link"

// Mock data - será substituído pela API Laravel
const userStats = {
  streak: 12,
  weeklyGoal: 4,
  weeklyCompleted: 3,
  totalMinutes: 245,
  caloriesBurned: 1840,
}

const todayWorkout = {
  id: "treino-hoje",
  title: "Treino de Peito e Tríceps",
  category: "musculacao" as const,
  duration: 45,
  calories: 320,
  exercises: 8,
  difficulty: "intermediario" as const,
}

const recommendedWorkouts = [
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
    id: "hiit-queima-gordura",
    title: "HIIT Queima de Gordura",
    category: "hiit" as const,
    duration: 20,
    calories: 280,
    exercises: 10,
    difficulty: "avancado" as const,
  },
  {
    id: "core-funcional",
    title: "Core e Funcional",
    category: "funcional" as const,
    duration: 25,
    calories: 180,
    exercises: 7,
    difficulty: "intermediario" as const,
  },
]

export default function HomePage() {
  return (
    <AppShell>
      <div className="p-4 md:p-8 space-y-8">
        {/* Header */}
        <header className="space-y-2">
          <p className="text-muted-foreground">Olá, Atleta</p>
          <h1 className="text-2xl md:text-3xl font-bold tracking-tight text-balance">
            Pronto para treinar hoje?
          </h1>
        </header>

        {/* Stats Grid */}
        <section className="grid grid-cols-2 gap-3 md:grid-cols-4 md:gap-4">
          <StatsCard
            title="Sequência"
            value={`${userStats.streak} dias`}
            icon={Flame}
            trend={{ value: 20, positive: true }}
          />
          <StatsCard
            title="Meta Semanal"
            value={`${userStats.weeklyCompleted}/${userStats.weeklyGoal}`}
            subtitle="treinos"
            icon={Target}
          />
          <StatsCard
            title="Tempo Total"
            value={`${userStats.totalMinutes}`}
            subtitle="minutos esta semana"
            icon={Clock}
          />
          <StatsCard
            title="Calorias"
            value={userStats.caloriesBurned}
            subtitle="kcal queimadas"
            icon={TrendingUp}
          />
        </section>

        {/* Today's Workout */}
        <section className="space-y-4">
          <div className="flex items-center justify-between">
            <h2 className="text-lg font-semibold">Treino de Hoje</h2>
          </div>
          
          <div className="relative overflow-hidden rounded-2xl bg-gradient-to-br from-primary/20 via-primary/10 to-transparent border border-primary/30 p-6">
            <div className="relative z-10 space-y-4">
              <div className="flex items-start justify-between">
                <div className="space-y-2">
                  <span className="inline-block rounded-md bg-primary/20 px-2 py-1 text-xs font-medium text-primary">
                    Musculação
                  </span>
                  <h3 className="text-xl font-bold">{todayWorkout.title}</h3>
                  <div className="flex items-center gap-4 text-sm text-muted-foreground">
                    <span className="flex items-center gap-1">
                      <Clock className="h-4 w-4" />
                      {todayWorkout.duration} min
                    </span>
                    <span className="flex items-center gap-1">
                      <Flame className="h-4 w-4 text-primary" />
                      {todayWorkout.calories} kcal
                    </span>
                    <span>{todayWorkout.exercises} exercícios</span>
                  </div>
                </div>
              </div>
              
              <Button className="w-full md:w-auto gap-2" size="lg">
                <Play className="h-5 w-5" />
                Iniciar Treino
              </Button>
            </div>
            
            {/* Decorative element */}
            <div className="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-primary/10 blur-3xl" />
          </div>
        </section>

        {/* AI Coach CTA */}
        <section>
          <Link href="/chat" className="block">
            <div className="group relative overflow-hidden rounded-xl bg-card border border-border p-4 transition-all hover:border-primary/50">
              <div className="flex items-center gap-4">
                <div className="flex h-12 w-12 items-center justify-center rounded-xl bg-primary">
                  <Sparkles className="h-6 w-6 text-primary-foreground" />
                </div>
                <div className="flex-1">
                  <h3 className="font-semibold group-hover:text-primary transition-colors">
                    Converse com seu Personal IA
                  </h3>
                  <p className="text-sm text-muted-foreground">
                    Tire dúvidas, peça dicas e receba treinos personalizados
                  </p>
                </div>
                <ChevronRight className="h-5 w-5 text-muted-foreground group-hover:text-primary transition-colors" />
              </div>
            </div>
          </Link>
        </section>

        {/* Recommended Workouts */}
        <section className="space-y-4">
          <div className="flex items-center justify-between">
            <h2 className="text-lg font-semibold">Treinos Recomendados</h2>
            <Link 
              href="/treinos" 
              className="text-sm text-primary hover:underline flex items-center gap-1"
            >
              Ver todos
              <ChevronRight className="h-4 w-4" />
            </Link>
          </div>
          
          <div className="space-y-3">
            {recommendedWorkouts.map((workout) => (
              <WorkoutCard key={workout.id} {...workout} />
            ))}
          </div>
        </section>
      </div>
    </AppShell>
  )
}
