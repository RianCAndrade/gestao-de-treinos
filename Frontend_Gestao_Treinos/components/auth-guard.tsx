"use client"

import { useAuth } from "@/hooks/use-auth"
import { Loader2 } from "lucide-react"

export function AuthGuard({ children }: { children: React.ReactNode }) {
  const { isAuthenticated } = useAuth()

  // Enquanto verifica se tem token, mostra loading
  if (isAuthenticated === null) {
    return (
      <div className="flex min-h-screen items-center justify-center bg-background">
        <Loader2 className="h-8 w-8 animate-spin text-primary" />
      </div>
    )
  }

  // Se não está autenticado, o useAuth já redireciona para /login
  // Não renderiza nada enquanto redireciona
  if (!isAuthenticated) {
    return null
  }

  // Está autenticado → mostra a página normalmente
  return <>{children}</>
}
