<?php

declare(strict_types=1);

/*
 * This file is part of the humbug/php-scoper package.
 *
 * Copyright (c) 2017 Théo FIDRY <theo.fidry@gmail.com>,
 *                    Pádraic Brady <padraic.brady@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'meta' => [
        'title' => 'Global constant imported with a use statement used in the global scope',
        // Default values. If not specified will be the one used
        'prefix' => 'Humbug',
        'whitelist' => [],
    ],

    // As it is extremely rare to use a `use const` statement for a built-in constant from the
    // global scope, we can relatively safely assume it is a user-land declared constant which should
    // be prefixed.

    [
        'spec' => <<<'SPEC'
Constant call imported with a use statement:
- prefix the use statement
- prefix the call
- transforms the call into a FQ call
SPEC
        ,
        'payload' => <<<'PHP'
<?php

use const DUMMY_CONST;

DUMMY_CONST;
----
<?php

use const Humbug\DUMMY_CONST;
\Humbug\DUMMY_CONST;

PHP
    ],

    [
        'spec' => <<<'SPEC'
FQ constant call imported with a use statement:
- prefix the use statement
SPEC
        ,
        'payload' => <<<'PHP'
<?php

use const DUMMY_CONST;

\DUMMY_CONST;
----
<?php

use const Humbug\DUMMY_CONST;
\DUMMY_CONST;

PHP
    ],
];
