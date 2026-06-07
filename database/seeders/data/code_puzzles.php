<?php

return [
    [
        'id' => 1,
        'title_key' => 'code_game.puzzle_1_title',
        'hint_key' => 'code_game.puzzle_1_hint',
        'lines' => ['a = 5', 'b = 3', 'result = a + b', 'print(result)'],
    ],
    [
        'id' => 2,
        'title_key' => 'code_game.puzzle_2_title',
        'hint_key' => 'code_game.puzzle_2_hint',
        'lines' => ['name = "Python"', 'message = "Сәлем, " + name', 'print(message)'],
    ],
    [
        'id' => 3,
        'title_key' => 'code_game.puzzle_3_title',
        'hint_key' => 'code_game.puzzle_3_hint',
        'lines' => ['age = 18', 'if age >= 18:', '    print("Ересек")', 'else:', '    print("Кәмелетке толмаған")'],
    ],
    [
        'id' => 4,
        'title_key' => 'code_game.puzzle_4_title',
        'hint_key' => 'code_game.puzzle_4_hint',
        'lines' => ['for i in range(3):', '    print(i * 2)'],
    ],
    [
        'id' => 5,
        'title_key' => 'code_game.puzzle_5_title',
        'hint_key' => 'code_game.puzzle_5_hint',
        'lines' => ['def greet(name):', '    return f"Сәлем, {name}!"', 'print(greet("Асхат"))'],
    ],
    [
        'id' => 6,
        'title_key' => 'code_game.puzzle_6_title',
        'hint_key' => 'code_game.puzzle_6_hint',
        'lines' => ['fruits = ["алма", "банан"]', 'fruits.append("апельсин")', 'for fruit in fruits:', '    print(fruit)'],
    ],
    [
        'id' => 7,
        'title_key' => 'code_game.puzzle_7_title',
        'hint_key' => 'code_game.puzzle_7_hint',
        'lines' => ['count = 0', 'while count < 3:', '    print(count)', '    count += 1'],
    ],
    [
        'id' => 8,
        'title_key' => 'code_game.puzzle_8_title',
        'hint_key' => 'code_game.puzzle_8_hint',
        'lines' => ['x = input("Сан: ")', 'number = int(x)', 'print(number * 2)'],
    ],
];
