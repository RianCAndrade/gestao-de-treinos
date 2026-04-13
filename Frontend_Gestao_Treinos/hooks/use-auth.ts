"use client"

import { useEffect, useState } from "react"
import { useRouter, usePathname } from "next/navigation"
import { api } from "@/lib/api"

// Rotas que NÃO precisam de autenticação
const publicRoutes = ["/login", "/cadastro"]

export function useAuth() {
  const router = useRouter()
  const pathname = usePathname()
  const [isAuthenticated, setIsAuthenticated] = useState<boolean | null>(null) // null = carregando

  useEffect(() => {
    const token = api.getToken()
    const isPublicRoute = publicRoutes.includes(pathname)

    if (token) {
      // Tem token → está logado
      setIsAuthenticated(true)

      // Se está logado e tentou acessar /login ou /cadastro, manda pro dashboard
      if (isPublicRoute) {
        router.replace("/")
      }
    } else {
      // Não tem token → não está logado
      setIsAuthenticated(false)

      // Se tentou acessar rota protegida, manda pro login
      if (!isPublicRoute) {
        router.replace("/login")
      }
    }
  }, [pathname, router])

  const logout = () => {
    api.clearToken()
    setIsAuthenticated(false)
    router.replace("/login")
  }

  return { isAuthenticated, logout }
}
