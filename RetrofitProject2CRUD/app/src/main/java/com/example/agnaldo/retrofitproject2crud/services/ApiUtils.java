package com.example.agnaldo.retrofitproject2crud.services;

public class ApiUtils {

    private ApiUtils(){

    }

    public static final String API_URL = "http://www.onlinnk.com.br/";

    public static TarefaService getTarefaService(){
        return RetrofitClient.getClient(API_URL).create(TarefaService.class);
    }


}
