<?php declare(strict_types=1);

namespace App\Notify;

use App\Shared\Mailer;
use App\Shared\Template;
use SWF\AbstractNotify;
use Exception;

class SimpleNotify extends AbstractNotify
{
    /**
     * Just get some data from database for example. All heavy work can be done at send() method.
     */
    public function __construct(
        protected string $email,
        protected string $message,
    ) {
    }

    /**
     * @inheritDoc
     *
     * @throws Exception
     */
    public function send(): void
    {
        $this
            ->s(Mailer::class)
            ->create()
            ->addRecipient($this->email)
            ->setSubject('Simple message')
            ->setBody(
                $this->s(Template::class)->transform('notify.send.message.html', [
                    'message' => $this->message,
                ]),
            )
            ->send()
        ;
    }
}
