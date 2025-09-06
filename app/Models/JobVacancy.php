<?php

namespace App\Models;

use Database\Factories\JobVacancyFactory;
use Eloquent;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $salary
 * @property string $location
 * @property string $category
 * @property string $level
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $employer_id
 * @property-read Employer $employer
 * @property-read Collection<int, JobApplication> $jobApplications
 * @property-read int|null $job_applications_count
 * @property-read User|null $user
 * @method static JobVacancyFactory factory($count = null, $state = [])
 * @method static Builder<static>|JobVacancy newModelQuery()
 * @method static Builder<static>|JobVacancy newQuery()
 * @method static Builder<static>|JobVacancy query()
 * @method static Builder<static>|JobVacancy search()
 * @method static Builder<static>|JobVacancy whereCategory($value)
 * @method static Builder<static>|JobVacancy whereCreatedAt($value)
 * @method static Builder<static>|JobVacancy whereDescription($value)
 * @method static Builder<static>|JobVacancy whereEmployerId($value)
 * @method static Builder<static>|JobVacancy whereId($value)
 * @method static Builder<static>|JobVacancy whereLevel($value)
 * @method static Builder<static>|JobVacancy whereLocation($value)
 * @method static Builder<static>|JobVacancy whereSalary($value)
 * @method static Builder<static>|JobVacancy whereStatus($value)
 * @method static Builder<static>|JobVacancy whereTitle($value)
 * @method static Builder<static>|JobVacancy whereUpdatedAt($value)
 * @mixin Eloquent
 */
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
    ];

    protected $fillable = [
        'employer_id',
        'user_id',
        'expected_salary',
        'cover_letter',
        'resume',
    ];

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
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

    public function isJobApplicable(Authenticatable|User|int $user): bool
    {
        return $this->jobApplications()
            ->where('user_id', $user->id ?? $user)
            ->where('job_vacancy_id', $this->id)
            ->doesntExist() && $this->status === 'open';
    }
}
