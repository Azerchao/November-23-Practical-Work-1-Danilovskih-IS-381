<?php
declare(strict_types=1);

require_once __DIR__ . '/Book.php';

class Library
{
    /** @var Book[] */
    private array $books = [];

    public function addBook(Book $book): void
    {
        $this->books[] = $book;
    }

    /** @return Book[] */
    public function findByAuthor(string $author): array
    {
        $found = array_filter(
            $this->books,
            fn(Book $b): bool => mb_stripos($b->author, $author) !== false
        );
        return array_values($found);
    }

    public function count(): int
    {
        return count($this->books);
    }

    public function printAll(): void
    {
        foreach ($this->books as $i => $book) {
            echo ($i + 1) . '. ' . $book->getInfo() . PHP_EOL;
        }
    }

    // Дополнительно: самая старая книга (null, если библиотека пуста)
    public function getOldest(): ?Book
    {
        $oldest = null;
        foreach ($this->books as $book) {
            if ($oldest === null || $book->year < $oldest->year) {
                $oldest = $book;
            }
        }
        return $oldest;
    }
}
