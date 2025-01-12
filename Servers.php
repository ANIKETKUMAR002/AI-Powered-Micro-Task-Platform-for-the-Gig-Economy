public function onMessage(ConnectionInterface $from, $msg)
{
    $data = json_decode($msg, true);

    // Save the bid to the database
    $bid = new Bid();
    $bid->task_id = $data['task_id'];
    $bid->freelancer_id = $data['freelancer_id'];
    $bid->amount = $data['bid'];
    $bid->save();

    // Broadcast the message to all connected clients
    foreach ($this->clients as $client) {
        if ($from !== $client) {
            $client->send(json_encode($data));
        }
    }
}
