<?php

    $selectedPronviceId = $_POST['id_provinsi'];
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $selectedPronviceId,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: b2f66aba54353d6eaa38e096c6af839b"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      
        $array_response = json_decode($response, true);
        $dataKota = $array_response["rajaongkir"]["results"];

        echo "<option value=''>--Pilih Kota--</option>";
        foreach($dataKota as $key => $tiap_kota){
            echo "<option value = '".$tiap_kota['city_id']."'
            id_distrik = '".$tiap_kota['city_id']."'
            nama_provinsi = '".$tiap_kota['province']."'
            nama_kota = '".$tiap_kota['city_name']."'
            tipe_distrik= '".$tiap_kota['type']."'
            kodepos= '".$tiap_kota['postal_code']."'>";
            echo $tiap_kota["type"]." ";
            echo $tiap_kota["city_name"];
            echo "</option>";
        }
    }
?>