<?php
declare(strict_types=1);

namespace App\Notify;

use App\Shared\Mailer;
use App\Shared\Template;
use SWF\AbstractNotify;
use SWF\Exception\TemplaterException;

class SimpleNotify extends AbstractNotify
{
    /**
     * Just get some data from database for example. All heavy work can be done at send() method.
     */
    public function __construct(
        private readonly string $email,
        private readonly string $message,
    ) {
    }

    /**
     * @inheritDoc
     *
     * @throws TemplaterException
     */
    public function send(): void
    {
        $subject = 'Simple message';

        $body = i(Template::class)->transform('notify.send.message.html', ['message' => $this->message])->getBody();

        i(Mailer::class)
            ->create()
            ->addRecipient($this->email)
            ->setSubject($subject)
            ->setBody($body)
            ->send()
        ;
    }
}
