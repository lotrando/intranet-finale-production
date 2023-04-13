<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CREATE TABLE calendar(
  id INT,
  date DATE
);

INSERT INTO calendar (id, date)
SELECT
    t.n+1,
    DATE_ADD('2023-01-01', INTERVAL t.n DAY)

FROM (
    SELECT
        a.N + b.N * 10 + c.N * 100 AS n
    FROM
        (SELECT 0 AS N UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) a
       ,(SELECT 0 AS N UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) b
       ,(SELECT 0 AS N UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4) c
    ORDER BY n
) t
WHERE
    t.n <= TIMESTAMPDIFF(DAY, '2023-01-01', '2023-12-31');

    }
}
