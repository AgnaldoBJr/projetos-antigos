package com.example.agnaldoburgojunior.myclassv1.Adapter;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.agnaldoburgojunior.myclassv1.Models.Curso;
import com.example.agnaldoburgojunior.myclassv1.R;

import java.util.List;

/**
 * Created by Andressa on 28/04/2016.
 */
public class CursoAdapter extends RecyclerView.Adapter<CursoAdapter.MyViewHolder1> {

    private List<Curso> mList;
    private LayoutInflater mLayoutInflater;
    private RecyclerViewOnClickListenerHack mRecyclerViewOnClickListenerHack;

    public CursoAdapter(Context c, List<Curso> l) {
        mList = l;
        mLayoutInflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    @Override
    public MyViewHolder1 onCreateViewHolder(ViewGroup parent, int viewType) {

        View v = mLayoutInflater.inflate(R.layout.item_lista2, parent, false);
        MyViewHolder1 mvh = new MyViewHolder1(v);

        return mvh;
    }

    @Override
    public void onBindViewHolder(MyViewHolder1 holder, int position) {

        holder.nome.setText(mList.get(position).getCursonome());
        holder.instit.setText(mList.get(position).getInstituicao());
    }

    @Override
    public int getItemCount() {
        return mList.size();
    }

    public void setRecyclerViewOnClickListenerHack(RecyclerViewOnClickListenerHack r) {
        mRecyclerViewOnClickListenerHack = r;
    }

    public void addListItem(Curso curso, int position) {
        mList.add(curso);
        notifyItemInserted(position);
        guardaCodigo(curso.getCodcurso(), position);
    }

    public int guardaCodigo(int codigo, int position){
        return codigo;
    }

    public class MyViewHolder1 extends RecyclerView.ViewHolder implements View.OnClickListener {

        public TextView nome,instit;

        public MyViewHolder1(View itemView) {
            super(itemView);

            nome = (TextView) itemView.findViewById(R.id.adp_txt1);
            instit = (TextView) itemView.findViewById(R.id.adp_txt2);

            itemView.setOnClickListener(this);
        }

        @Override
        public void onClick(View v) {
            if (mRecyclerViewOnClickListenerHack != null) {
                mRecyclerViewOnClickListenerHack.onClickListener(v, getPosition());
            }
        }
    }
}