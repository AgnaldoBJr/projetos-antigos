package com.example.agnaldoburgojunior.myclassv1.Adapter;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.agnaldoburgojunior.myclassv1.Models.Falta;
import com.example.agnaldoburgojunior.myclassv1.R;

import java.util.List;

/**
 * Created by Andressa on 29/05/2016.
 */
public class FaltaAdapter extends RecyclerView.Adapter<FaltaAdapter.MyViewHolder1> {

    private List<Falta> mList;
    private LayoutInflater mLayoutInflater;
    private RecyclerViewOnClickListenerHack mRecyclerViewOnClickListenerHack;

    public FaltaAdapter(Context c, List<Falta> l) {
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

        holder.disc.setText(mList.get(position).getNomeDisciplina(mList.get(position).getCoddisciplina()));
        holder.data.setText(mList.get(position).getMotivo()+" \n"+mList.get(position).getData());
    }

    @Override
    public int getItemCount() {
        return mList.size();
    }

    public void setRecyclerViewOnClickListenerHack(RecyclerViewOnClickListenerHack r) {
        mRecyclerViewOnClickListenerHack = r;
    }

    public void addListItem(Falta falta, int position) {
        mList.add(falta);
        notifyItemInserted(position);
        guardaCodigo(falta.getCodfalta(), position);
    }

    public int guardaCodigo(int codigo, int position){
        return codigo;
    }

    public class MyViewHolder1 extends RecyclerView.ViewHolder implements View.OnClickListener {

        public TextView disc,data;

        public MyViewHolder1(View itemView) {
            super(itemView);

            disc = (TextView) itemView.findViewById(R.id.adp_txt1);
            data = (TextView) itemView.findViewById(R.id.adp_txt2);

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
