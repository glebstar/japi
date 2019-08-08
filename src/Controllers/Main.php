<?php

namespace App\Controllers;

use App\Models\Session;
use App\Models\Participant;
use App\Models\SessionUser;

class Main
{
    /**
     * Доступные для чтения таблицы
     * @var array
     */
    private $_allowedTables = [
        'News',
        'Session',
    ];

    /**
     * Запрос данных таблиц
     */
    public function table()
    {
        if (!isset($_POST['table'])) {
            return $this->response([], 'Отсутствует обязательный параметр table', true);
        }

        if (!in_array($_POST['table'], $this->_allowedTables)) {
            return $this->response([], 'Указана запрещенная таблица', true);
        }

        $class = 'App\Models\\' . $_POST['table'];

        if (isset($_POST['id']) && $_POST['id']) {
            $instance = $class::find($_POST['id']);

            if (!$instance) {
                return $this->response([], 'Экземпляр таблицы не найден', true);
            }

            return $this->response($instance);
        } else {
            return $this->response($class::get());
        }
    }

    /**
     * Запись на сессию
     */
    public function sessionSubscribe()
    {
        if (!isset($_POST['sessionId'])) {
            return $this->response([], 'Отсутствует обязательный параметр sessionId', true);
        }

        if (!isset($_POST['userEmail'])) {
            return $this->response([], 'Отсутствует обязательный параметр userEmail', true);
        }

        $session = Session::find($_POST['sessionId']);
        if (!$session) {
            return $this->response([], 'Сессия не найдена', true);
        }

        $user = Participant::where('Email', $_POST['userEmail'])->first();
        if (!$user) {
            return $this->response([], 'Пользователь не найден', true);
        }

        // проверка свободных мест
        $seats = SessionUser::where('SessionID', $session->ID)->count();
        if ($seats >= $session->Seats) {
            return $this->response([], 'Извините, все места заняты', true);
        }

        // записан ли пользователь ранее
        $seat = SessionUser::where('SessionID', $session->ID)
            ->where('UserID', $user->ID)
            ->first();
        if ($seat) {
            return $this->response([], 'Вы уже были записаны на эту сессию', true);
        }

        // можно записывать
        SessionUser::create([
            'SessionID' => $session->ID,
            'UserID' => $user->ID,
        ]);

        return $this->response([], 'Спасибо, вы успешно записаны!');
    }

    /**
     * Возвращает ответ сервера
     *
     * @param $payload
     * @param string $message
     * @param bool $error
     */
    public function response($payload, $message="", $error=false)
    {
        header('Content-Type: application/json');

        echo json_encode([
            'status'  => $error ? 'error' : 'ok',
            'payload' => $payload,
            'message' => $message,
        ]);

        exit;
    }
}
