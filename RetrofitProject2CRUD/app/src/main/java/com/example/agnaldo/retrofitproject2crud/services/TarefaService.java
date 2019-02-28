package com.example.agnaldo.retrofitproject2crud.services;

import com.example.agnaldo.retrofitproject2crud.models.Tarefa;

import java.util.List;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.DELETE;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.PUT;
import retrofit2.http.Path;

public interface TarefaService {

    @GET("tarefas/")
    Call<List<Tarefa>> getTarefas();

    @POST("tarefas/")
    Call<Tarefa> createTarefa(@Body Tarefa tarefa);

    @PUT("tarefas/{id}")
    Call<Tarefa> updateTarefa(@Path("id") int id, @Body Tarefa tarefa);

    @DELETE("tarefas/{id}")
    Call<Tarefa> deleteTarefa(@Path("id") int id);

}
