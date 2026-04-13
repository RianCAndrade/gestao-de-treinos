"use client"

import { useState, useRef, useEffect } from "react"
import { AppShell } from "@/components/app-shell"
import { Button } from "@/components/ui/button"
import { 
  Send, 
  Sparkles, 
  User,
  Dumbbell,
  Target,
  Utensils,
  TrendingUp,
  Loader2
} from "lucide-react"
import { cn } from "@/lib/utils"
import { api } from "@/lib/api"

interface Message {
  id: string
  role: "user" | "assistant"
  content: string
  timestamp: Date
}

const suggestedQuestions = [
  {
    icon: Dumbbell,
    text: "Monte um treino de peito para iniciantes",
  },
  {
    icon: Target,
    text: "Como melhorar minha técnica de agachamento?",
  },
  {
    icon: Utensils,
    text: "O que comer antes do treino?",
  },
  {
    icon: TrendingUp,
    text: "Como ganhar massa muscular?",
  },
]

export default function ChatPage() {
  const [messages, setMessages] = useState<Message[]>([])
  const [input, setInput] = useState("")
  const [isLoading, setIsLoading] = useState(false)
  const messagesEndRef = useRef<HTMLDivElement>(null)
  const inputRef = useRef<HTMLTextAreaElement>(null)

  const scrollToBottom = () => {
    messagesEndRef.current?.scrollIntoView({ behavior: "smooth" })
  }

  useEffect(() => {
    scrollToBottom()
  }, [messages])

  const handleSubmit = async () => {
    if (!input.trim() || isLoading) return

    const userMessage: Message = {
      id: Date.now().toString(),
      role: "user",
      content: input.trim(),
      timestamp: new Date(),
    }

    setMessages((prev) => [...prev, userMessage])
    setInput("")
    setIsLoading(true)

    try {
      const response = await api.sendChatMessage(userMessage.content)

      const assistantMessage: Message = {
        id: (Date.now() + 1).toString(),
        role: "assistant",
        content: response.message.content,
        timestamp: new Date(),
      }

      setMessages((prev) => [...prev, assistantMessage])
    } catch {
      const errorMessage: Message = {
        id: (Date.now() + 1).toString(),
        role: "assistant",
        content: "Desculpe, ocorreu um erro ao processar sua mensagem. Tente novamente.",
        timestamp: new Date(),
      }
      setMessages((prev) => [...prev, errorMessage])
    } finally {
      setIsLoading(false)
    }
  }

  const handleSuggestionClick = (text: string) => {
    setInput(text)
    inputRef.current?.focus()
  }

  const handleKeyDown = (e: { key: string; shiftKey: boolean; preventDefault: () => void }) => {
    if (e.key === "Enter" && !e.shiftKey) {
      e.preventDefault()
      handleSubmit()
    }
  }

  return (
    <AppShell>
      <div className="flex flex-col h-[calc(100vh-80px)] md:h-screen">
        {/* Header */}
        <header className="shrink-0 border-b border-border bg-card/50 backdrop-blur-lg p-4">
          <div className="flex items-center gap-3">
            <div className="flex h-10 w-10 items-center justify-center rounded-xl bg-primary">
              <Sparkles className="h-5 w-5 text-primary-foreground" />
            </div>
            <div>
              <h1 className="font-semibold">Personal Trainer IA</h1>
              <p className="text-sm text-muted-foreground">Sempre disponível para ajudar</p>
            </div>
          </div>
        </header>

        {/* Messages */}
        <div className="flex-1 overflow-y-auto p-4 space-y-4">
          {messages.length === 0 ? (
            <div className="flex flex-col items-center justify-center h-full space-y-6 text-center px-4">
              <div className="flex h-16 w-16 items-center justify-center rounded-2xl bg-primary/10">
                <Sparkles className="h-8 w-8 text-primary" />
              </div>
              <div className="space-y-2 max-w-md">
                <h2 className="text-xl font-semibold">Olá! Sou seu Personal IA</h2>
                <p className="text-muted-foreground">
                  Estou aqui para ajudá-lo com treinos, dicas de exercícios, 
                  nutrição e tudo sobre fitness. Como posso ajudar?
                </p>
              </div>
              
              {/* Suggested Questions */}
              <div className="w-full max-w-md space-y-2">
                <p className="text-sm text-muted-foreground">Sugestões:</p>
                <div className="grid grid-cols-1 gap-2">
                  {suggestedQuestions.map((suggestion, index) => (
                    <button
                      key={index}
                      onClick={() => handleSuggestionClick(suggestion.text)}
                      className="flex items-center gap-3 rounded-xl border border-border bg-card p-3 text-left text-sm transition-all hover:border-primary/50 hover:bg-card/80"
                    >
                      <suggestion.icon className="h-5 w-5 text-primary shrink-0" />
                      <span>{suggestion.text}</span>
                    </button>
                  ))}
                </div>
              </div>
            </div>
          ) : (
            <>
              {messages.map((message) => (
                <div
                  key={message.id}
                  className={cn(
                    "flex gap-3",
                    message.role === "user" ? "justify-end" : "justify-start"
                  )}
                >
                  {message.role === "assistant" && (
                    <div className="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-primary">
                      <Sparkles className="h-4 w-4 text-primary-foreground" />
                    </div>
                  )}
                  
                  <div
                    className={cn(
                      "max-w-[80%] rounded-2xl px-4 py-3",
                      message.role === "user"
                        ? "bg-primary text-primary-foreground"
                        : "bg-card border border-border"
                    )}
                  >
                    <div className="whitespace-pre-wrap text-sm">
                      {message.content}
                    </div>
                    <div className={cn(
                      "mt-1 text-xs",
                      message.role === "user" 
                        ? "text-primary-foreground/70" 
                        : "text-muted-foreground"
                    )}>
                      {message.timestamp.toLocaleTimeString("pt-BR", {
                        hour: "2-digit",
                        minute: "2-digit",
                      })}
                    </div>
                  </div>
                  
                  {message.role === "user" && (
                    <div className="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-secondary">
                      <User className="h-4 w-4 text-muted-foreground" />
                    </div>
                  )}
                </div>
              ))}
              
              {isLoading && (
                <div className="flex gap-3 justify-start">
                  <div className="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-primary">
                    <Sparkles className="h-4 w-4 text-primary-foreground" />
                  </div>
                  <div className="bg-card border border-border rounded-2xl px-4 py-3">
                    <div className="flex items-center gap-2 text-sm text-muted-foreground">
                      <Loader2 className="h-4 w-4 animate-spin" />
                      Pensando...
                    </div>
                  </div>
                </div>
              )}
              
              <div ref={messagesEndRef} />
            </>
          )}
        </div>

        {/* Input */}
        <div className="shrink-0 border-t border-border bg-card/50 backdrop-blur-lg p-4">
          <form onSubmit={(e) => { e.preventDefault(); handleSubmit() }} className="flex gap-2">
            <textarea
              ref={inputRef}
              value={input}
              onChange={(e) => setInput(e.target.value)}
              onKeyDown={handleKeyDown}
              placeholder="Digite sua pergunta..."
              rows={1}
              className="flex-1 resize-none rounded-xl border border-border bg-background px-4 py-3 text-sm placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 disabled:opacity-50"
              disabled={isLoading}
            />
            <Button
              type="submit"
              size="icon"
              className="h-12 w-12 shrink-0 rounded-xl"
              disabled={!input.trim() || isLoading}
            >
              <Send className="h-5 w-5" />
            </Button>
          </form>
          <p className="mt-2 text-xs text-center text-muted-foreground">
            IA pode cometer erros. Consulte um profissional para orientações específicas.
          </p>
        </div>
      </div>
    </AppShell>
  )
}
