<?php

namespace App\Words\Domain\Repository;

use App\Words\Domain\Aggregate\LearningHistory;

interface LearningHistoryRepositoryInterface
{
    public function add(LearningHistory $learningHistory): void;

    public function delete(LearningHistory $learningHistory): void;
}