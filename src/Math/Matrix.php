<?php

namespace Cipher\Math;

use Exception;

class Matrix
{
    /**
     * @var array
     */
    private $matrix;

    /**
     * @var int
     */
    private $columnsCount;

    /**
     * @var int
     */
    private $rowsCount;

    public function __construct(array $matrix)
    {
        $this->matrix = $matrix;
        $this->rowsCount = count($matrix);
        $this->columnsCount = count($matrix[0]);
    }

    /**
     * Create matrix from a flat array.
     *
     * @param  array  $array
     * @return static
     */
    public static function fromFlatArray(array $array): self
    {
        $matrix = [];
        foreach ($array as $value) {
            $matrix[] = [$value];
        }
        return new self($matrix);
    }

    /**
     * Get the row count of the matrix.
     *
     * @return int
     */
    public function getRowsCount(): int
    {
        return $this->rowsCount;
    }

    /**
     * Get the column count for the matrix.
     *
     * @return int
     */
    public function getColumnsCount(): int
    {
        return $this->columnsCount;
    }


    /**
     * Get values of a specific column.
     *
     * @throws Exception
     */
    public function getColumnValues(int $column): array
    {
        if ($column >= $this->columnsCount) {
            throw new Exception('Column out of range.');
        }
        return array_column($this->matrix, $column);
    }

    /**
     * Multiply the matrix by another matrix.
     *
     * @see https://en.wikipedia.org/wiki/Matrix_multiplication
     * @param  Matrix  $matrix
     * @return $this
     */
    public function multiply(self $matrix): self
    {
        $firstArray = $this->toArray();
        $secondArray = $matrix->toArray();
        $secondArrayColumnCount = $matrix->getColumnsCount();

        if ($this->canMultipliedBy($matrix)) {
            throw new Exception('Columns of the first array must be equal to the rows of the second array.');
        }

        $result = [];
        foreach ($firstArray as $row => $rowValues) {
            for ($col = 0; $col < $secondArrayColumnCount; $col++) {
                $secondArrayColumnValues = array_column($secondArray, $col);
                $dotProduct = 0;
                foreach ($secondArrayColumnValues as $rowIndex => $rowValue) {
                    $dotProduct += $rowValue * $rowValues[$rowIndex];
                }
                $result[$row][$col] = $dotProduct;
            }
        }

        return new self($result);
    }

    /**
     * Get the matrix as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->matrix;
    }

    /**
     * Determine if this matrix can multiplied by another matrix.
     *
     * @param  Matrix  $array1
     * @return bool
     */
    private function canMultipliedBy(self $matrix): bool
    {
        return $this->getColumnsCount() != $matrix->getRowsCount();
    }
}
