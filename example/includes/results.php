<?php

/**
 * RESULTS:
 */

// Fetch the results of an experiments
dump($optimizely->experiment($experimentId)->legacyResults());