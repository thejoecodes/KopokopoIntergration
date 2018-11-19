<?php
	
	/* use one function for all this */
	function sinetiks_schools_create() {
		$id = $_POST["id"];
		$name = $_POST["name"];
		//insert
		if (isset($_POST['insert'])) {
			global $wpdb;
			$table_name = $wpdb->prefix . "school";

			$wpdb->insert(
					$table_name, //table
					array('id' => $id, 'name' => $name), //data
					array('%s', '%s') //data format			
			);
			$message.="School inserted";
		}
	}

	/**
     * Logic to check if amount paid is the required amount and storing in the database.
    */
    function transactPayment($amount, $transaction_data, $transBalance)
    {
		$password = str_random(8);
			
		if($amount == 997)
		{
			$balance = 0;
			$message = "Thank you ".$transaction_data['first_name']." for your payment of Ksh ".number_format($transaction_data['amount'],2)." . Your login password is ".$password;

			$transData = [
				"paysys" => "kopokopo",
				"account_number" => $transaction_data['account_number'],
				"amount" => $transaction_data['amount'],
				"balance" => $balance,
				"business_number" => $transaction_data['business_number'],
				"currency" => $transaction_data['currency'],
				"first_name" => $transaction_data['first_name'],
				"internal_transaction_id" => $transaction_data['internal_transaction_id'],
				"last_name" => $transaction_data['last_name'],
				"middle_name" => $transaction_data['middle_name'],
				"sender_phone" => $transaction_data['sender_phone'],
				"service_name" => $transaction_data['service_name'],
				"transaction_reference" => $transaction_data['transaction_reference'],
				"transaction_timestamp" => $transaction_data['transaction_timestamp'],
				"transaction_type" => $transaction_data['transaction_type'],
				"username" => "Asuredbet",
				"signature" => $transaction_data['signature']
			];
			
			//store in payments table
			$this->paymentRepository->store($transData);
			
			//update user password
			$userid = $this->userRepository->updatePassword($transData, $password);
			
			$subscribe = [
				"user_id" => $userid,
				"start_at" => Carbon::now()->format('y-m-d h:m:s'),
				"end_at" => Carbon::now()->addDays(30)->format('y-m-d h:m:s')
			];
			//update subscription details
			$this->subscriptionRepository->store($subscribe);
			
			return $message;
		}
		elseif($amount > 997)
		{
			$balance = 997 - floor($amount);
			$message = "Thank you ".$transaction_data['first_name']." for your payment of Ksh ".number_format($transaction_data['amount'],2)." . Overpayment will be debited next. Your login password is ".$password;

			$transData = [
				"paysys" => "kopokopo",
				"account_number" => $transaction_data['account_number'],
				"amount" => $transaction_data['amount'],
				"balance" => $balance,
				"business_number" => $transaction_data['business_number'],
				"currency" => $transaction_data['currency'],
				"first_name" => $transaction_data['first_name'],
				"internal_transaction_id" => $transaction_data['internal_transaction_id'],
				"last_name" => $transaction_data['last_name'],
				"middle_name" => $transaction_data['middle_name'],
				"sender_phone" => $transaction_data['sender_phone'],
				"service_name" => $transaction_data['service_name'],
				"transaction_reference" => $transaction_data['transaction_reference'],
				"transaction_timestamp" => $transaction_data['transaction_timestamp'],
				"transaction_type" => $transaction_data['transaction_type'],
				"username" => "Asuredbet",
				"signature" => $transaction_data['signature']
			];
			
			//store in payments table
			$this->paymentRepository->store($transData);
			
			//update user password
			$userid = $this->userRepository->updatePassword($transData, $password);
			
			$subscribe = [
				"user_id" => $userid,
				"start_at" => Carbon::now()->format('y-m-d h:m:s'),
				"end_at" => Carbon::now()->addDays(30)->format('y-m-d h:m:s')
			];
			//update subscription details
			$this->subscriptionRepository->store($subscribe);
			
			return $message;
		}
		elseif($amount < 997)
		{
			$balance = $transBalance - floor($transaction_data['amount']);
			$message = "Thank you ".$transaction_data['first_name']." for your payment of Ksh ".number_format($transaction_data['amount'],2)." . Kindly top up with Ksh ".$balance." to get a login password.";

			$transData = [
				"paysys" => "kopokopo",
				"account_number" => $transaction_data['account_number'],
				"amount" => $transaction_data['amount'],
				"balance" => $balance,
				"business_number" => $transaction_data['business_number'],
				"currency" => $transaction_data['currency'],
				"first_name" => $transaction_data['first_name'],
				"internal_transaction_id" => $transaction_data['internal_transaction_id'],
				"last_name" => $transaction_data['last_name'],
				"middle_name" => $transaction_data['middle_name'],
				"sender_phone" => $transaction_data['sender_phone'],
				"service_name" => $transaction_data['service_name'],
				"transaction_reference" => $transaction_data['transaction_reference'],
				"transaction_timestamp" => $transaction_data['transaction_timestamp'],
				"transaction_type" => $transaction_data['transaction_type'],
				"username" => "Asuredbet",
				"signature" => $transaction_data['signature']
			];
			
			//store in payments table
			$this->paymentRepository->store($transData);
			
			return $message;
		}
	}
	
    /**
     * Receive payment from kopokopo server and respond.
    */
	function kopokopo_kopokopo_create()
	{
		$data = $request->all();
		
		// set json string to php variables
		if (isset($data['transaction_reference']))
		{
			$service_name = $data['service_name'];
		        $business_number = $data['business_number'];
		        $transaction_reference = $data['transaction_reference'];
		        $internal_transaction_id = $data['internal_transaction_id'];
		        $transaction_timestamp = $data['transaction_timestamp'];
		        $transaction_type = $data['transaction_type'];
		        $account_number = $data['account_number'];
		        $sender_phone = $data['sender_phone'];
		        $first_name = $data['first_name'];
		        $last_name = $data['last_name'];
		        $middle_name = $data['middle_name'];
		        $amount = $data['amount'];
		        $currency = $data['currency'];
		        $signature = $data['signature'];
		}
		// set json string to php variables
		else
		{
			$service_name = $_POST['service_name'];
			$business_number = $_POST['business_number'];
			$transaction_reference = $_POST['transaction_reference'];
			$internal_transaction_id = $_POST['internal_transaction_id'];
			$transaction_timestamp = $_POST['transaction_timestamp'];
			$transaction_type = $_POST['transaction_type'];
			$account_number = $_POST['account_number'];
			$sender_phone = $_POST['sender_phone'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$middle_name = $_POST['middle_name'];
			$amount = $_POST['amount'];
			$currency = $_POST['currency'];
			$signature = $_POST['signature'];
		}

		if($business_number == 297610)
		{
			$base_string =
		            "account_number=".$account_number.
		            "&amount=".$amount.
		            "&business_number=".$business_number.
		            "&currency=".$currency.
		            "&first_name=".$first_name.
		            "&internal_transaction_id=".$internal_transaction_id.
		            "&last_name=".$last_name.
		            "&middle_name=".$middle_name.
		            "&sender_phone=".$sender_phone.
		            "&service_name=".$service_name.
		            "&transaction_reference=".$transaction_reference.
		            "&transaction_timestamp=".$transaction_timestamp.
		            "&transaction_type=".$transaction_type;
			
			$symmetric_key = env('KOPOKOPO_API');
			$signature_created = base64_encode( hash_hmac("sha1", $base_string, $symmetric_key,true));

			if($signature_created == $signature)
			{	
				$transaction_data = [
					"account_number" => $account_number,
					"amount" => $amount,
					"business_number" => $business_number,
					"currency" => $currency,
					"first_name" => $first_name,
					"internal_transaction_id" => $internal_transaction_id,
					"last_name" => $last_name,
					"middle_name" => $middle_name,
					"sender_phone" => $sender_phone,
					"service_name" => $service_name,
					"transaction_reference" => $transaction_reference,
					"transaction_timestamp" => $transaction_timestamp,
					"transaction_type" => $transaction_type,
					"signature" => $signature
				];
				
				// start
				$password = str_random(8);
				$previousTrans = $this->paymentRepository->getPaymentsOrderWithPhonenumber($sender_phone);
				if(!empty($previousTrans))
				{
					if($previousTrans['balance'] == 0)
					{
						$message = $this->transactPayment(floor($transaction_data['amount']), $transaction_data, $balance = 997);
					}
					elseif($previousTrans['balance'] < 0)
					{
						$amountTrans = floor($transaction_data['amount']) - ($previousTrans['balance']);
						$message = $this->transactPayment($amountTrans, $transaction_data, $previousTrans['balance']);
					}
					elseif($previousTrans['balance'] > 0)
					{
						$amountTrans = floor($transaction_data['amount']);
						$message = $this->transactPayment($amountTrans, $transaction_data, $previousTrans['balance']);
					} 
				}
				else
				{
					$message = $this->transactPayment(floor($transaction_data['amount']), $transaction_data, $balance = 997);
				} 
				// stop 
					
				// create the response
				$response = array();
				$response["status"] = "01";
				$response["description"] = "Accepted";
				$response["subscriber_message"] = $message;

				//json encode the response
				return json_encode($response);
			}
			else
			{
				// create the response
				$response = array();
				$response["status"] = "03";
				$response["description"] = "Invalid signature";

				//json encode the response
				return json_encode($response);
			}
		}
	}

	/**
     * Check the last payment of the subject user making payment.
    */
	function getPaymentsOrderWithPhonenumber($sender_phone)
    {
        return $this->model->where('sender_phone', $sender_phone)->latest()->first();
    }