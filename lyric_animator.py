import time
import os
from colorama import Fore, Back, Style, init

init(autoreset=True)

def clear_screen():
    os.system('cls' if os.name == 'nt' else 'clear')

def typing_effect(text, color=Fore.CYAN, speed=0.05):
    """Character-by-character typing effect"""
    for char in text:
        print(color + char + Style.RESET_ALL, end='', flush=True)
        time.sleep(speed)
    print()

def color_cycle(text, speed=0.1):
    """Cycle through colors"""
    colors = [Fore.RED, Fore.YELLOW, Fore.GREEN, Fore.CYAN, Fore.BLUE, Fore.MAGENTA]
    for char in text:
        color = colors[text.index(char) % len(colors)]
        print(color + char + Style.RESET_ALL, end='', flush=True)
        time.sleep(speed)
    print()

def bounce_effect(text, speed=0.05):
    """Bouncing animation"""
    max_width = 60
    for i in range(len(text) + max_width):
        spaces = max(0, min(i, max_width - len(text)))
        print('\r' + ' ' * spaces + Fore.MAGENTA + text + Style.RESET_ALL, end='', flush=True)
        time.sleep(speed)
    print()

def glitch_effect(text, speed=0.08):
    """Glitch animation effect"""
    for _ in range(3):
        print(Fore.RED + text + Style.RESET_ALL)
        time.sleep(speed)
        print(Fore.YELLOW + text + Style.RESET_ALL)
        time.sleep(speed)
        print(Fore.CYAN + text + Style.RESET_ALL)
        time.sleep(speed)

def full_show():
    """Run all effects"""
    clear_screen()
    
    print(Fore.CYAN + "=" * 50)
    print(Fore.CYAN + " " * 12 + "✨ LYRIC ANIMATOR ✨")
    print(Fore.CYAN + "=" * 50 + "\n")
    
    time.sleep(0.5)
    
    # Effect 1: Typing
    print(Fore.GREEN + "[1] Typing Effect:")
    typing_effect("OH QUE SERA", color=Fore.GREEN, speed=0.08)
    time.sleep(1)
    
    # Effect 2: Color Cycle
    print(Fore.YELLOW + "[2] Color Cycling:")
    color_cycle("OH QUE SERA", speed=0.12)
    time.sleep(1)
    
    # Effect 3: Bouncing
    print(Fore.MAGENTA + "[3] Bouncing Effect:")
    bounce_effect("OH QUE SERA", speed=0.04)
    time.sleep(1)
    
    # Effect 4: Glitch
    print(Fore.RED + "[4] Glitch Effect:")
    glitch_effect("OH QUE SERA", speed=0.1)
    time.sleep(1)
    
    # Effect 5: Rainbow
    print(Fore.CYAN + "[5] Rainbow Fade:")
    colors = [Fore.RED, Fore.YELLOW, Fore.GREEN, Fore.CYAN, Fore.BLUE, Fore.MAGENTA]
    for color in colors:
        print(color + "OH QUE SERA" + Style.RESET_ALL)
        time.sleep(0.3)
    
    time.sleep(1)
    print(Fore.CYAN + "\n" + "=" * 50)
    print(Fore.CYAN + "✨ Whatever will be, will be ✨")
    print(Fore.CYAN + "=" * 50)

if __name__ == "__main__":
    full_show()
