<?php
namespace App\Data;

class RecipeCategories
{
    const CATEGORIES_SEARCH_KEYWORD_MAP = [
        'suga-free',
        'meat',
        'fish and seafood',
        'dairy-free',
        'vegetarian',
        'vegan',
        'nut-free',
        'low-carb',
        'high-carb',
        'post-workout',
        'high-protein',
        'easy',
        'ready in 30 minutes',
        'under 200 kcal',
        '200-400 kcal',
        '400-600 kcal',
        '600-800 kcal',
        'breakfast',
        'lunch',
        'dinner',
        'snack',
    ];

    public static function exists($name)
    {
        return in_array($name, self::CATEGORIES_SEARCH_KEYWORD_MAP);
    }
}