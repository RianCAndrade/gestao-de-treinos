"use client"

import { useState } from "react"
import { AppShell } from "@/components/app-shell"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { 
  User,
  Mail,
  Phone,
  Calendar,
  Ruler,
  Weight,
  Target,
  Award,
  Flame,
  TrendingUp,
  Edit2,
  Camera,
  ChevronRight,
  LogOut,
  Settings,
  Bell,
  Shield,
  HelpCircle
} from "lucide-react"
import { cn } from "@/lib/utils"

// Mock data - será substituído pela API Laravel
const userData = {
  name: "Carlos Silva",
  email: "carlos@email.com",
  phone: "(11) 99999-9999",
  birthDate: "1990-05-15",
  height: 175,
  weight: 78,
  goal: "hipertrofia",
  level: "intermediario",
  memberSince: "2024-01-15",
  stats: {
    totalWorkouts: 48,
    streak: 12,
    totalMinutes: 2160,
    totalCalories: 15680,
  },
  achievements: [
    { id: "1", title: "Primeira Semana", description: "Complete 7 dias de treino", unlocked: true },
    { id: "2", title: "Madrugador", description: "Treine antes das 6h", unlocked: true },
    { id: "3", title: "Consistência", description: "30 dias seguidos", unlocked: false },
    { id: "4", title: "Força Total", description: "100 treinos completos", unlocked: false },
  ],
}

const goalLabels = {
  hipertrofia: "Hipertrofia",
  emagrecimento: "Emagrecimento",
  condicionamento: "Condicionamento",
  forca: "Força",
}

const levelLabels = {
  iniciante: "Iniciante",
  intermediario: "Intermediário",
  avancado: "Avançado",
}

const menuItems = [
  { icon: Settings, label: "Configurações", href: "/configuracoes" },
  { icon: Bell, label: "Notificações", href: "/notificacoes" },
  { icon: Shield, label: "Privacidade", href: "/privacidade" },
  { icon: HelpCircle, label: "Ajuda", href: "/ajuda" },
]

export default function PerfilPage() {
  const [isEditing, setIsEditing] = useState(false)

  return (
    <AppShell>
      <div className="p-4 md:p-8 space-y-6 max-w-2xl mx-auto">
        {/* Profile Header */}
        <section className="flex flex-col items-center text-center space-y-4">
          <div className="relative">
            <div className="h-24 w-24 rounded-full bg-secondary flex items-center justify-center">
              <User className="h-12 w-12 text-muted-foreground" />
            </div>
            <button className="absolute bottom-0 right-0 h-8 w-8 rounded-full bg-primary flex items-center justify-center text-primary-foreground shadow-lg">
              <Camera className="h-4 w-4" />
            </button>
          </div>
          
          <div className="space-y-1">
            <h1 className="text-2xl font-bold">{userData.name}</h1>
            <p className="text-muted-foreground">
              Membro desde {new Date(userData.memberSince).toLocaleDateString("pt-BR", { month: "long", year: "numeric" })}
            </p>
          </div>

          <div className="flex items-center gap-3">
            <span className="rounded-full bg-primary/20 px-3 py-1 text-sm font-medium text-primary">
              {goalLabels[userData.goal as keyof typeof goalLabels]}
            </span>
            <span className="rounded-full bg-secondary px-3 py-1 text-sm font-medium text-muted-foreground">
              {levelLabels[userData.level as keyof typeof levelLabels]}
            </span>
          </div>
        </section>

        {/* Stats */}
        <section className="grid grid-cols-2 gap-3 md:grid-cols-4">
          <div className="rounded-xl bg-card border border-border p-4 text-center">
            <Flame className="h-6 w-6 text-primary mx-auto mb-2" />
            <p className="text-2xl font-bold">{userData.stats.streak}</p>
            <p className="text-xs text-muted-foreground">Dias seguidos</p>
          </div>
          <div className="rounded-xl bg-card border border-border p-4 text-center">
            <Target className="h-6 w-6 text-primary mx-auto mb-2" />
            <p className="text-2xl font-bold">{userData.stats.totalWorkouts}</p>
            <p className="text-xs text-muted-foreground">Treinos</p>
          </div>
          <div className="rounded-xl bg-card border border-border p-4 text-center">
            <TrendingUp className="h-6 w-6 text-primary mx-auto mb-2" />
            <p className="text-2xl font-bold">{Math.floor(userData.stats.totalMinutes / 60)}h</p>
            <p className="text-xs text-muted-foreground">Treinando</p>
          </div>
          <div className="rounded-xl bg-card border border-border p-4 text-center">
            <Award className="h-6 w-6 text-primary mx-auto mb-2" />
            <p className="text-2xl font-bold">{userData.achievements.filter(a => a.unlocked).length}</p>
            <p className="text-xs text-muted-foreground">Conquistas</p>
          </div>
        </section>

        {/* Personal Info */}
        <section className="space-y-4">
          <div className="flex items-center justify-between">
            <h2 className="text-lg font-semibold">Informações Pessoais</h2>
            <Button
              variant="ghost"
              size="sm"
              onClick={() => setIsEditing(!isEditing)}
              className="gap-2"
            >
              <Edit2 className="h-4 w-4" />
              {isEditing ? "Salvar" : "Editar"}
            </Button>
          </div>

          <div className="rounded-xl bg-card border border-border divide-y divide-border">
            <div className="flex items-center gap-4 p-4">
              <Mail className="h-5 w-5 text-muted-foreground" />
              <div className="flex-1">
                <p className="text-sm text-muted-foreground">E-mail</p>
                {isEditing ? (
                  <Input defaultValue={userData.email} className="mt-1" />
                ) : (
                  <p className="font-medium">{userData.email}</p>
                )}
              </div>
            </div>
            
            <div className="flex items-center gap-4 p-4">
              <Phone className="h-5 w-5 text-muted-foreground" />
              <div className="flex-1">
                <p className="text-sm text-muted-foreground">Telefone</p>
                {isEditing ? (
                  <Input defaultValue={userData.phone} className="mt-1" />
                ) : (
                  <p className="font-medium">{userData.phone}</p>
                )}
              </div>
            </div>
            
            <div className="flex items-center gap-4 p-4">
              <Calendar className="h-5 w-5 text-muted-foreground" />
              <div className="flex-1">
                <p className="text-sm text-muted-foreground">Data de Nascimento</p>
                <p className="font-medium">
                  {new Date(userData.birthDate).toLocaleDateString("pt-BR")}
                </p>
              </div>
            </div>
            
            <div className="flex items-center gap-4 p-4">
              <Ruler className="h-5 w-5 text-muted-foreground" />
              <div className="flex-1">
                <p className="text-sm text-muted-foreground">Altura</p>
                {isEditing ? (
                  <Input defaultValue={userData.height} type="number" className="mt-1" />
                ) : (
                  <p className="font-medium">{userData.height} cm</p>
                )}
              </div>
            </div>
            
            <div className="flex items-center gap-4 p-4">
              <Weight className="h-5 w-5 text-muted-foreground" />
              <div className="flex-1">
                <p className="text-sm text-muted-foreground">Peso</p>
                {isEditing ? (
                  <Input defaultValue={userData.weight} type="number" className="mt-1" />
                ) : (
                  <p className="font-medium">{userData.weight} kg</p>
                )}
              </div>
            </div>
          </div>
        </section>

        {/* Achievements */}
        <section className="space-y-4">
          <h2 className="text-lg font-semibold">Conquistas</h2>
          
          <div className="grid grid-cols-2 gap-3">
            {userData.achievements.map((achievement) => (
              <div
                key={achievement.id}
                className={cn(
                  "rounded-xl border p-4 transition-all",
                  achievement.unlocked
                    ? "bg-primary/5 border-primary/30"
                    : "bg-card border-border opacity-60"
                )}
              >
                <Award className={cn(
                  "h-8 w-8 mb-2",
                  achievement.unlocked ? "text-primary" : "text-muted-foreground"
                )} />
                <h3 className="font-medium text-sm">{achievement.title}</h3>
                <p className="text-xs text-muted-foreground mt-1">
                  {achievement.description}
                </p>
              </div>
            ))}
          </div>
        </section>

        {/* Menu Items */}
        <section className="space-y-2">
          {menuItems.map((item) => (
            <button
              key={item.label}
              className="w-full flex items-center gap-4 rounded-xl bg-card border border-border p-4 transition-all hover:border-primary/50"
            >
              <item.icon className="h-5 w-5 text-muted-foreground" />
              <span className="flex-1 text-left font-medium">{item.label}</span>
              <ChevronRight className="h-5 w-5 text-muted-foreground" />
            </button>
          ))}
        </section>

        {/* Logout */}
        <Button variant="outline" className="w-full gap-2 text-destructive hover:text-destructive hover:bg-destructive/10">
          <LogOut className="h-5 w-5" />
          Sair da Conta
        </Button>
      </div>
    </AppShell>
  )
}
