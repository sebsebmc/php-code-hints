<?php

/**
 * Make unified diff of two strings.
 *
 * Makes an unified diff containing differences between <var>$old_data</var> string and <var>$new_data</var> string and
 * returns it. The resulting diff is human-readable. An optional context parameter specifies how many lines of context
 * should be added around each change. Setting minimal parameter to <code>TRUE</code> will result in outputting the
 * shortest patch file possible (can take a long time).
 *
 * @param string $old_data
 *   First string with data. It acts as "old" data.
 * @param string $new_data
 *   Second string with data. It acts as "new" data.
 * @param integer $context [optional]
 *   Indicates how many lines of context you want to include in the diff result. Defaults to <code>3</code>
 * @param boolean $minimal [optional]
 *   Set this parameter to <code>TRUE</code> if you want to minimalize the size of the result (can take a long time).
 *   Defaults to <code>FALSE</code>.
 * @return string
 *   Returns string with resulting diff or <code>FALSE</code> if an internal error happened.
 * @since 0.2.0
 */
function xdiff_string_diff($old_data, $new_data, $context = 3, $minimal = false) {}
