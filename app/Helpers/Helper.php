<?php

/**
 * Use to share data to blade
 *
 * @param array $data
 * @return void
 */
function viewShare(array $data): void
{
    foreach ($data as $key => $value) {
        View::share($key, $value);
    }
}

/**
 * Description : use to format to rupiah
 *
 * @param float $number value for format
 * @return string
 */
function formatToRupiah(float $number): string
{
    return "Rp " . number_format($number, 2, ",", ".");
}

/**
 * @param Exception $e
 * @return array
 */
function getDefaultErrorResponse(Exception $e): array
{
    return [
        "success" => false,
        "message" => config('app.env') != 'production' ? $e->getMessage() : 'Something went wrong'
    ];
}
