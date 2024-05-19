@push('css')
    <style>
        .container {
            position: relative;
        }

        .element {
            width: 150px;
            height: 50px;
            text-align: center;
            line-height: 50px;
            cursor: pointer;
        }

        .popover {
            display: none;
            position: absolute;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 0%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            padding: 10px;
            width: 200px;
            top: calc(100% + 10px);
            left: 0;
            z-index: 999;
        }

        .element:hover+.popover {
            display: block;
        }
    </style>
@endpush
@php
    $appointmentRating = Modules\AppointmentReview\Entities\AppointmentReview::where(
        'appointment_id',
        $Appointment->id,
    )->first();
    $ratingDescription = $appointmentRating ? $appointmentRating->description : '';
    $appointmentAverageRating = Modules\AppointmentReview\Entities\AppointmentReview::AverageRatingForAppointment(
        $Appointment->id,
    );
@endphp
<td>
    <div class="container">
        <div class="element">
            @if ($appointmentAverageRating == 0.0)
                <span class="theme-text-color">-</span>
            @else
                @for ($i = 1; $i <= 5; $i++)
                    @if ($appointmentAverageRating < $i)
                        @if (is_float($appointmentAverageRating) && round($appointmentAverageRating) == $i)
                            <i class="text-warning fas fa-star-half-alt"></i>
                        @else
                            <i class="fas fa-star"></i>
                        @endif
                    @else
                        <i class="text-warning fas fa-star"></i>
                    @endif
                @endfor
                <span class="theme-text-color">({{ number_format($appointmentAverageRating, 1) }})</span>
            @endif
        </div>
        @if ($appointmentAverageRating != 0.0)
            <div class="popover">
                {{ $ratingDescription ?: 'Review Not Found' }}
            </div>
        @endif
    </div>
</td>

