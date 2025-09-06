<?php

namespace App\Models;

use Database\Factories\JobApplicationFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property int $job_vacancy_id
 * @property int|null $expected_salary
 * @property string|null $resume
 * @property string|null $cover_letter
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read JobVacancy $jobVacancy
 * @property-read User $user
 * @method static JobApplicationFactory factory($count = null, $state = [])
 * @method static Builder<static>|JobApplication newModelQuery()
 * @method static Builder<static>|JobApplication newQuery()
 * @method static Builder<static>|JobApplication query()
 * @method static Builder<static>|JobApplication whereCoverLetter($value)
 * @method static Builder<static>|JobApplication whereCreatedAt($value)
 * @method static Builder<static>|JobApplication whereExpectedSalary($value)
 * @method static Builder<static>|JobApplication whereId($value)
 * @method static Builder<static>|JobApplication whereJobVacancyId($value)
 * @method static Builder<static>|JobApplication whereResume($value)
 * @method static Builder<static>|JobApplication whereStatus($value)
 * @method static Builder<static>|JobApplication whereUpdatedAt($value)
 * @method static Builder<static>|JobApplication whereUserId($value)
 * @mixin Eloquent
 */
class JobApplication extends Model
{
    /** @use HasFactory<JobApplicationFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_vacancy_id',
        'expected_salary',
        'cover_letter',
        'resume',
        'status',
    ];

    public static array $statuses = [
        'pending',
        'accepted',
        'rejected',
    ];

    protected $casts = [
        'expected_salary' => 'integer',
    ];

    protected $attributes = [
        'status' => 'pending',
    ];

    public function jobVacancy(): BelongsTo
    {
        return $this->belongsTo(JobVacancy::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
