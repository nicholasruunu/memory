### OOP-PHP Memory with TDD (PHPSpec)

## Interface (WIP)

```
ScoreCalculator
  calculate(PlaySheet)

CardRepository
    add
    remove

Game(Deck, ScoreCalculator)
    id(): Uuid
    play(cardPosition): Card

Games
    add(Game)
    find(Uuid id)

Card(SplFileInfo image)
    matches(Card): bool
    clone(Card): Card
    getImage(): string

CardCollection
    add(Card)
    shuffle()
    getCards()

PlaySheet
    record(Card, Card)
    getRecords()

DeckGenerator(CardRepository)
    generate(size): Deck

Deck(CardCollection)
    turn(position): Card
    remove(Card)
```
