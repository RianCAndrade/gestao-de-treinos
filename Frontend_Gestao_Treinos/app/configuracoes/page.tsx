"use client"

import { useState } from "react"
import { AppShell } from "@/components/app-shell"
import { Button } from "@/components/ui/button"
import { 
  ArrowLeft,
  Bell,
  Moon,
  Globe,
  Volume2,
  Vibrate,
  Shield,
  Database,
  Trash2,
  ChevronRight
} from "lucide-react"
import Link from "next/link"
import { cn } from "@/lib/utils"

interface ToggleProps {
  enabled: boolean
  onChange: (enabled: boolean) => void
}

function Toggle({ enabled, onChange }: ToggleProps) {
  return (
    <button
      onClick={() => onChange(!enabled)}
      className={cn(
        "relative h-6 w-11 rounded-full transition-colors",
        enabled ? "bg-primary" : "bg-secondary"
      )}
    >
      <span
        className={cn(
          "absolute top-0.5 left-0.5 h-5 w-5 rounded-full bg-white transition-transform",
          enabled && "translate-x-5"
        )}
      />
    </button>
  )
}

export default function ConfiguracoesPage() {
  const [settings, setSettings] = useState({
    notifications: true,
    darkMode: true,
    sound: true,
    vibration: true,
    workoutReminder: true,
    weeklyReport: true,
  })

  const updateSetting = (key: keyof typeof settings) => {
    setSettings((prev) => ({ ...prev, [key]: !prev[key] }))
  }

  return (
    <AppShell>
      <div className="p-4 md:p-8 space-y-6 max-w-2xl mx-auto">
        {/* Header */}
        <header className="space-y-4">
          <Link 
            href="/perfil" 
            className="inline-flex items-center gap-2 text-muted-foreground hover:text-foreground transition-colors"
          >
            <ArrowLeft className="h-4 w-4" />
            Voltar
          </Link>
          
          <h1 className="text-2xl md:text-3xl font-bold tracking-tight">Configurações</h1>
        </header>

        {/* Notifications Section */}
        <section className="space-y-4">
          <h2 className="text-sm font-medium text-muted-foreground uppercase tracking-wider">
            Notificações
          </h2>
          
          <div className="rounded-xl bg-card border border-border divide-y divide-border">
            <div className="flex items-center justify-between p-4">
              <div className="flex items-center gap-3">
                <Bell className="h-5 w-5 text-muted-foreground" />
                <div>
                  <p className="font-medium">Notificações Push</p>
                  <p className="text-sm text-muted-foreground">Receba alertas no seu dispositivo</p>
                </div>
              </div>
              <Toggle 
                enabled={settings.notifications} 
                onChange={() => updateSetting("notifications")} 
              />
            </div>
            
            <div className="flex items-center justify-between p-4">
              <div className="flex items-center gap-3">
                <Volume2 className="h-5 w-5 text-muted-foreground" />
                <div>
                  <p className="font-medium">Sons</p>
                  <p className="text-sm text-muted-foreground">Sons de feedback durante treinos</p>
                </div>
              </div>
              <Toggle 
                enabled={settings.sound} 
                onChange={() => updateSetting("sound")} 
              />
            </div>
            
            <div className="flex items-center justify-between p-4">
              <div className="flex items-center gap-3">
                <Vibrate className="h-5 w-5 text-muted-foreground" />
                <div>
                  <p className="font-medium">Vibração</p>
                  <p className="text-sm text-muted-foreground">Vibrar ao trocar de exercício</p>
                </div>
              </div>
              <Toggle 
                enabled={settings.vibration} 
                onChange={() => updateSetting("vibration")} 
              />
            </div>
          </div>
        </section>

        {/* Reminders Section */}
        <section className="space-y-4">
          <h2 className="text-sm font-medium text-muted-foreground uppercase tracking-wider">
            Lembretes
          </h2>
          
          <div className="rounded-xl bg-card border border-border divide-y divide-border">
            <div className="flex items-center justify-between p-4">
              <div>
                <p className="font-medium">Lembrete de Treino</p>
                <p className="text-sm text-muted-foreground">Receba lembretes para treinar</p>
              </div>
              <Toggle 
                enabled={settings.workoutReminder} 
                onChange={() => updateSetting("workoutReminder")} 
              />
            </div>
            
            <div className="flex items-center justify-between p-4">
              <div>
                <p className="font-medium">Relatório Semanal</p>
                <p className="text-sm text-muted-foreground">Resumo de performance semanal</p>
              </div>
              <Toggle 
                enabled={settings.weeklyReport} 
                onChange={() => updateSetting("weeklyReport")} 
              />
            </div>
          </div>
        </section>

        {/* Appearance Section */}
        <section className="space-y-4">
          <h2 className="text-sm font-medium text-muted-foreground uppercase tracking-wider">
            Aparência
          </h2>
          
          <div className="rounded-xl bg-card border border-border divide-y divide-border">
            <div className="flex items-center justify-between p-4">
              <div className="flex items-center gap-3">
                <Moon className="h-5 w-5 text-muted-foreground" />
                <div>
                  <p className="font-medium">Modo Escuro</p>
                  <p className="text-sm text-muted-foreground">Ativado</p>
                </div>
              </div>
              <Toggle 
                enabled={settings.darkMode} 
                onChange={() => updateSetting("darkMode")} 
              />
            </div>
            
            <button className="w-full flex items-center justify-between p-4">
              <div className="flex items-center gap-3">
                <Globe className="h-5 w-5 text-muted-foreground" />
                <div className="text-left">
                  <p className="font-medium">Idioma</p>
                  <p className="text-sm text-muted-foreground">Português (Brasil)</p>
                </div>
              </div>
              <ChevronRight className="h-5 w-5 text-muted-foreground" />
            </button>
          </div>
        </section>

        {/* Data & Privacy Section */}
        <section className="space-y-4">
          <h2 className="text-sm font-medium text-muted-foreground uppercase tracking-wider">
            Dados e Privacidade
          </h2>
          
          <div className="rounded-xl bg-card border border-border divide-y divide-border">
            <button className="w-full flex items-center justify-between p-4">
              <div className="flex items-center gap-3">
                <Database className="h-5 w-5 text-muted-foreground" />
                <div className="text-left">
                  <p className="font-medium">Exportar Dados</p>
                  <p className="text-sm text-muted-foreground">Baixe uma cópia dos seus dados</p>
                </div>
              </div>
              <ChevronRight className="h-5 w-5 text-muted-foreground" />
            </button>
            
            <button className="w-full flex items-center justify-between p-4">
              <div className="flex items-center gap-3">
                <Shield className="h-5 w-5 text-muted-foreground" />
                <div className="text-left">
                  <p className="font-medium">Política de Privacidade</p>
                  <p className="text-sm text-muted-foreground">Leia nossa política</p>
                </div>
              </div>
              <ChevronRight className="h-5 w-5 text-muted-foreground" />
            </button>
          </div>
        </section>

        {/* Danger Zone */}
        <section className="space-y-4">
          <h2 className="text-sm font-medium text-destructive uppercase tracking-wider">
            Zona de Perigo
          </h2>
          
          <Button variant="outline" className="w-full gap-2 text-destructive hover:text-destructive hover:bg-destructive/10">
            <Trash2 className="h-5 w-5" />
            Excluir Conta
          </Button>
        </section>

        {/* Version */}
        <p className="text-center text-sm text-muted-foreground">
          Gest Treinos v1.0.0
        </p>
      </div>
    </AppShell>
  )
}
