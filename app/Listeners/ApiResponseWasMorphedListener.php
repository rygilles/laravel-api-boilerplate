<?php

namespace App\Listeners;

use Dingo\Api\Event\ResponseWasMorphed;

/**
 * Class ApiResponseWasMorphedListener.
 *
 * Add extra headers when returning Api response (Useful for HEAD http method)
 */
class ApiResponseWasMorphedListener
{
    public function handle(ResponseWasMorphed $event)
    {
        // Convert pagination meta to headers
        if (isset($event->content['meta'])) {
            if (isset($event->content['meta']['pagination'])) {
                $pagination = $event->content['meta']['pagination'];

                $event->response->headers->set('Pagination-Total', $pagination['total']);
                $event->response->headers->set('Pagination-Count', $pagination['count']);
                $event->response->headers->set('Pagination-Per-Page', $pagination['per_page']);
                $event->response->headers->set('Pagination-Current-Page', $pagination['current_page']);
                $event->response->headers->set('Pagination-Total-Pages', $pagination['total_pages']);
            }
        }
    }
}
