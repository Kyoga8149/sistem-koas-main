<?php

namespace App\Enums;

enum InstitutionType: string
{
    case School = 'school';
    case Healthcare = 'healthcare';
}

enum InstitutionSubType: string
{
    case SMK = 'smk';
    case University = 'university';
    case Hospital = 'hospital';
}
