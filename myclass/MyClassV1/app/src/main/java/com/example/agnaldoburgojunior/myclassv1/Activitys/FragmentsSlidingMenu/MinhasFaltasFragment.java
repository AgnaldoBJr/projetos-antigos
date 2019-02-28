package com.example.agnaldoburgojunior.myclassv1.Activitys.FragmentsSlidingMenu;

import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.example.agnaldoburgojunior.myclassv1.Activitys.FaltaView;
import com.example.agnaldoburgojunior.myclassv1.Adapter.FaltaAdapter;
import com.example.agnaldoburgojunior.myclassv1.Adapter.RecyclerViewOnClickListenerHack;
import com.example.agnaldoburgojunior.myclassv1.Controllers.FaltaDAO;
import com.example.agnaldoburgojunior.myclassv1.Custom.DividerItemDecoration;
import com.example.agnaldoburgojunior.myclassv1.Models.Falta;
import com.example.agnaldoburgojunior.myclassv1.R;

import java.util.List;

/**
 * Created by Andressa on 29/05/2016.
 */
public class MinhasFaltasFragment extends Fragment {

    com.github.clans.fab.FloatingActionButton novo;
    RecyclerView mRecyclerView;
    List<Falta> mList;

    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_minhas_faltas, container, false);

        novo = (com.github.clans.fab.FloatingActionButton) v.findViewById(R.id.nova_falta);
        mRecyclerView = (RecyclerView) v.findViewById(R.id.list_falta);

        novo.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(getContext(), FaltaView.class);
                Bundle b = new Bundle();
                b.putInt("cod", 0);
                i.putExtras(b);
                startActivity(i);
            }
        });

        return v;
    }

    @Override
    public void onResume() {
        super.onResume();

        FaltaDAO t = new FaltaDAO();
        mList = t.selectTodosFalta();

        mRecyclerView.setHasFixedSize(true);
        mRecyclerView.setOnScrollListener(new RecyclerView.OnScrollListener() {
            @Override
            public void onScrollStateChanged(RecyclerView recyclerView, int newState) {
                super.onScrollStateChanged(recyclerView, newState);
            }

            @Override
            public void onScrolled(RecyclerView recyclerView, int dx, int dy) {
                super.onScrolled(recyclerView, dx, dy);

                LinearLayoutManager llm = (LinearLayoutManager) mRecyclerView.getLayoutManager();
                FaltaAdapter adp = (FaltaAdapter) mRecyclerView.getAdapter();

                if (mList.size() == llm.findFirstCompletelyVisibleItemPosition() + 1) {
                    FaltaDAO t = new FaltaDAO();

                    List<Falta> listAux = t.selectTodosFalta();


                    for (int i = 0; i < listAux.size(); i++) {
                        adp.addListItem(listAux.get(i), mList.size());
                    }
                }
            }
        });

        LinearLayoutManager llm = new LinearLayoutManager(getContext());
        llm.setOrientation(LinearLayoutManager.VERTICAL);
        mRecyclerView.setLayoutManager(llm);

        mList = t.selectTodosFalta();
        FaltaAdapter adp = new FaltaAdapter(getContext(), mList);

        adp.setRecyclerViewOnClickListenerHack(new RecyclerViewOnClickListenerHack() {
            @Override
            public void onClickListener(View view, int position) {

                //Toast.makeText(getContext(), mList.get(position).getCodreferncias().toString(), Toast.LENGTH_LONG).show();
                Intent myIntent = new Intent(getContext(), FaltaView.class);
                Bundle b = new Bundle();
                b.putInt("cod", mList.get(position).getCodfalta());
                b.putBoolean("visibilidade", true);
                myIntent.putExtras(b);
                startActivity(myIntent);

            }
        });
        mRecyclerView.addItemDecoration(new DividerItemDecoration(getContext(), LinearLayoutManager.VERTICAL));
        mRecyclerView.setAdapter(adp);



    }

}
