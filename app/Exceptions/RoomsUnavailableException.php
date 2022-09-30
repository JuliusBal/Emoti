<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;

class RoomsUnavailableException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return RedirectResponse
     */
    public function render($request): RedirectResponse
    {
        return back()->withInput()->withErrors(['total_customers' => $this->getMessage()]);
    }
}
