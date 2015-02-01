### OOP-PHP Memory with TDD (PHPSpec)

## Interface (WIP)

```
ScoreCalculator
  calculate(PlaySheet)

CardRepository
    add
    remove

Memory(ScoreCalculator, PlaySheet, Deck)
    play(position, position)
    score()

Game(playSheet, Deck)
    createFrom(playSheet, Deck)

Card(SplFileInfo image)
    matches(Card): bool
    clone(Card): Card
    getImage(): string

CardCollection
    add(Card)
    shuffle()
    shift()

PlaySheet
    record(Card, Card)
    getRecords()

DeckGenerator(CardRepository)
    generate(size): Deck

Deck(CardCollection)
    turn(posistion): Card
    remove(Card)
```
