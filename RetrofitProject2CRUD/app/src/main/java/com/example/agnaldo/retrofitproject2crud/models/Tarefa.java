package com.example.agnaldo.retrofitproject2crud.models;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class Tarefa {

    @SerializedName("id")
    @Expose
    private int id;

    @SerializedName("descricao")
    @Expose
    private String descricao;

    @SerializedName("data_cad")
    @Expose
    private String data_cad;

    public Tarefa(){

    }

    public Tarefa(String descricao, String data_cad) {
        this.descricao = descricao;
        this.data_cad = data_cad;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getDescricao() {
        return descricao;
    }

    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }

    public String getData_cad() {
        return data_cad;
    }

    public void setData_cad(String data_cad) {
        this.data_cad = data_cad;
    }
}
