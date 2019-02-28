package com.example.agnaldoburgojunior.myclassv1.Models;

/**
 * Created by Andressa on 25/03/2016.
 */
public class Curso {

    private Integer codcurso;
    private Integer ra;
    private String cursonome;
    private String turno;
    private Integer semestre;
    private Integer porcaprovacao;
    private String instituicao;
    private Integer mediaaprov;

    public Integer getMediaaprov() {
        return mediaaprov;
    }

    public void setMediaaprov(Integer mediaaprov) {
        this.mediaaprov = mediaaprov;
    }

    public Integer getCodcurso() {
        return codcurso;
    }

    public int setCodcurso(Integer codcurso) {
        this.codcurso = codcurso;
        return 0;
    }

    public Integer getRa() {
        return ra;
    }

    public void setRa(Integer ra) {
        this.ra = ra;
    }

    public String getCursonome() {
        return cursonome;
    }

    public void setCursonome(String cursonome) {
        this.cursonome = cursonome;
    }

    public String getTurno() {
        return turno;
    }

    public void setTurno(String turno) {
        this.turno = turno;
    }

    public Integer getSemestre() {
        return semestre;
    }

    public void setSemestre(Integer semestre) {
        this.semestre = semestre;
    }

    public Integer getPorcaprovacao() {
        return porcaprovacao;
    }

    public void setPorcaprovacao(Integer porcaprovacao) {
        this.porcaprovacao = porcaprovacao;
    }

    public String getInstituicao() {
        return instituicao;
    }

    public void setInstituicao(String instituicao) {
        this.instituicao = instituicao;
    }

    @Override
    public String toString() {
        return getCursonome();
    }
}
