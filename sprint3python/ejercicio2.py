import random

opciones = ["piedra", "papel", "tijera", "lagarto", "spock"]

reglas = {
    "tijera": ["papel", "lagarto"],
    "papel": ["piedra", "spock"],
    "piedra": ["tijera", "lagarto"],
    "spock": ["piedra", "tijera"],
    "lagarto": ["spock", "papel"]
}

def resultados(usuario, cpu):
    if usuario == cpu:
        return 0
    elif cpu in reglas[usuario]:
        return 1 
    else:   
        return -1

def jugarRonda():
    while True:
        playerUsuario = input("Elige una opcion (piedra, papel, tijera, lagarto, spock): ").lower()
        if playerUsuario in opciones:
            break
        print("entrada invalida introduce nuevamente opcion. ")
    cpu = random.choice(opciones)
    print(f"tu eleccion fue {playerUsuario}")
    print(f"la máquina eligió: {cpu}")
    resultado = resultados(playerUsuario, cpu)

    if resultado == 1:
        print("ganaste esta ronda")
    elif resultado == -1:
        print("la maquina ganó esta ronda")
    else:
        print("empate entre hombre y maquina... ")
    return resultado


def jugarPartida():
    while True:
        try:
            n = int(input("cuantas rondas deseas jugar?  selecciona un numero impar para determinar ganador:  "))
            if n >= 1 and n % 2 == 1:
                break
            print("debes seleccionar un numero impar y que sea mayor que 1. ")
        except ValueError:
            print("Entrada invalida introduce solo numero y que sea impar. ")
    victoriasUsuario = 0
    victoriasCpu = 0
    rondasTotales = n // 2 + 1 

    while victoriasUsuario < rondasTotales and victoriasCpu < rondasTotales:
        resultado = jugarRonda()
        if resultado == 1:
            victoriasUsuario += 1
        elif resultado == -1:
            victoriasCpu += 1
        print (f"marcador: tú {victoriasUsuario} -maquina {victoriasCpu}\n")

    if victoriasUsuario > victoriasCpu:
        print("ganaste tu la partida. ")
    else:
        print("Ganó la máquina la partida")

def main():
    while True:
        jugarPartida()
        repetir="";
        while repetir not in ["s", "n"]:
            repetir = input("quieres jugar otra vez más? ").lower()
            #print("por favor solo s para si o n para no")
            if repetir not in ["s", "n"]:
                print("por favor solo una de las dos opciones o S o N")
            if repetir == "n":
                print("gracias por jugar. Hasta la proxima!!!!!!!!")
                break

main()