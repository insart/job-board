<?php

namespace App\Models;

use Database\Factories\JobVacancyFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobVacancy extends Model
{
    /** @use HasFactory<JobVacancyFactory> */
    use HasFactory;

    public static array $categories = [
        'IT',
        'Marketing',
        'Sales',
        'Finance',
        'Human Resources',
        'Legal',
        'Engineering',
        'Customer Service',
        'Administration',
    ];

    public static array $levels = [
        'entry',
        'mid',
        'senior',
    ];

    public static array $statuses = [
        'open',
        'closed',
        'pending',
    ];

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    #[Scope]
    protected function search(Builder $query): Builder
    {
        $filters = request()->only(['search', 'category', 'level', 'min_salary', 'max_salary']);

        return $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->orWhere('location', 'like', '%'.$search.'%')
                    ->orWhereHas('employer', function ($query) use ($search) {
                        $query->where('name', 'like', '%'.$search.'%');
                    });
            });
        })
            ->when($filters['min_salary'] ?? null, function ($query) use ($filters) {
                $query->where('salary', '>=', $filters['min_salary']);
            })
            ->when($filters['max_salary'] ?? null, function ($query) use ($filters) {
                $query->where('salary', '<=', $filters['max_salary']);
            })
            ->when($filters['level'] ?? null, function ($query) use ($filters) {
                $query->where('level', '=', $filters['level']);
            })
            ->when($filters['category'] ?? null, function ($query) use ($filters) {
                $query->where('category', '=', $filters['category']);
            });
    }
}
