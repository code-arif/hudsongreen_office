<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FitnessTestResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Main test data
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'scoring_type' => $this->scoring_type,
        ];

        // Conditional rules array
        $rules = [];

        switch ($this->id) {
            case 1: // AGILITY
                $rules = $this->agilityRules();
                break;
            case 2: // FLEXIBILITY
                $rules = $this->flexibilityRules();
                break;
            case 3: // BALANCE
                $rules = $this->balanceRules();
                break;
            case 4: // COORDINATIOS
                $rules = $this->coordinationRules();
                break;
            case 5: // REACTION
                $rules = $this->reactionRules();
                break;
            case 6: // POWER
                $rules = $this->powerRules();
                break;
            case 7: // STRENGTH
                $rules = $this->strengthRules();
                break;
            case 8: // STAMINA
                $rules = $this->staminaRules();
                break;
            case 9: // SPEED
                $rules = $this->speedRules();
                break;
            case 10: // CARDIOVASCULAR
                $rules = $this->cardiovascularRules();
                break;
        }

        $data['rules'] = $rules;

        return $data;
    }

    // agility
    private function agilityRules(): array
    {
        // 14.0 → 30.0 step 0.1
        $values = range(14.0, 30.0, 0.1);

        // Format to 1 decimal point
        return array_map(function ($v) {
            return number_format($v, 1);
        }, $values);
    }

    // flexibility
    private function flexibilityRules(): array
    {
        // Generate range from -12 to 25 (step = 1)
        $values = range(-12, 25, 1);

        // Format as simple integers (or keep as they are)
        return array_map(function ($v) {
            return (int) $v;
        }, $values);
    }

    // balance
    private function balanceRules(): array
    {
        // Generate range from 0 to 90 with step 2
        $values = range(0, 90, 2);

        return array_map(function ($v) {
            return (int) $v;
        }, $values);
    }

    // coodination
    private function coordinationRules(): array
    {
        // Generate range from 1 to 45 with step 1
        $values = range(1, 45, 1);

        return array_map(function ($v) {
            return (int) $v;
        }, $values);
    }

    // reaciton
    private function reactionRules(): array
    {
        // Generate range from 1 to 60
        $values = range(1, 60, 1);

        return array_map(function ($v) {
            return (int) $v;
        }, $values);
    }

    // power
    private function powerRules(): array
    {
        // Generate values from 90.0 to 200.0 with step 0.1
        $values = range(90, 200, 0.1);

        // Format to 1 decimal place
        return array_map(function ($v) {
            return number_format($v, 1, '.', '');
        }, $values);
    }

    // strength
    private function strengthRules(): array
    {
        // Generate values from 1.0 to 60.0 with step 0.1
        $values = range(1, 60, 0.1);

        // Format to 1 decimal place
        return array_map(function ($v) {
            return number_format($v, 1, '.', '');
        }, $values);
    }


    // stamina
    private function staminaRules(): array
    {
        // Generate values from 1 to 200 with step 1
        $values = range(1, 200, 1);

        return array_map(function ($v) {
            return (int) $v;
        }, $values);
    }


    // speed
    private function speedRules(): array
    {
        // Generate values from 1.0 to 10.0 with step 0.1
        $values = range(1, 10, 0.1);

        // Format to 1 decimal place
        return array_map(function ($v) {
            return number_format($v, 1, '.', '');
        }, $values);
    }

    // Cardiovascular endurance
    private function cardiovascularRules(): array
    {
        // Generate values from 1.0 to 20.0 with step 0.1
        $values = range(1, 20, 0.1);

        // Format to 1 decimal place
        return array_map(function ($v) {
            return number_format($v, 1, '.', '');
        }, $values);
    }
}
