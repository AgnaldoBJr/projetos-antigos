package com.example.agnaldoburgojunior.myclassv1.Models;

import com.example.agnaldoburgojunior.myclassv1.Controllers.TipoReferenciaDAO;

/**
 * Created by Andressa on 25/03/2016.
 */
public class Referencia {

    private Integer codreferncias;
    private Integer codtipo;
    private String titulo;
    private String autor;
    private String edicao;
    private String ano;
    private String url;
    private String dataacesso;
    private String comentarios;

    public String getComentarios() {
        return comentarios;
    }

    public void setComentarios(String comentarios) {
        this.comentarios = comentarios;
    }

    public Integer getCodreferncias() {
        return codreferncias;
    }

    public void setCodreferncias(Integer codreferncias) {
        this.codreferncias = codreferncias;
    }

    public Integer getCodtipo() {
        return codtipo;
    }

    public void setCodtipo(Integer codtipo) {
        this.codtipo = codtipo;
    }

    public String getTitulo() {
        return titulo;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }

    public String getAutor() {
        return autor;
    }

    public void setAutor(String autor) {
        this.autor = autor;
    }

    public String getEdicao() {
        return edicao;
    }

    public void setEdicao(String edicao) {
        this.edicao = edicao;
    }

    public String getAno() {
        return ano;
    }

    public void setAno(String ano) {
        this.ano = ano;
    }

    public String getUrl() {
        return url;
    }

    public void setUrl(String url) {
        this.url = url;
    }

    public String getDataacesso() {
        return dataacesso;
    }

    public void setDataacesso(String dataacesso) {
        this.dataacesso = dataacesso;
    }

    @Override
    public String toString() {
        return getTitulo();
    }

    public String getTipoRef(int position){
        TipoReferenciaDAO tipoReferenciaDAO  = new TipoReferenciaDAO();
        TipoReferencia tipoReferencia = new TipoReferencia();
        tipoReferencia = tipoReferenciaDAO.selectTipoReferencia(position);
        String teste = tipoReferencia.getNome();
        return teste;
    }
}