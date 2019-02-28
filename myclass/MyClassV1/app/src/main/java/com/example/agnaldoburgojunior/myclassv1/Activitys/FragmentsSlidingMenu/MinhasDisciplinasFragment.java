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

import com.example.agnaldoburgojunior.myclassv1.Activitys.DisciplinaView;
import com.example.agnaldoburgojunior.myclassv1.Adapter.DisciplinaAdapter;
import com.example.agnaldoburgojunior.myclassv1.Adapter.RecyclerViewOnClickListenerHack;
import com.example.agnaldoburgojunior.myclassv1.Controllers.DisciplinaDAO;
import com.example.agnaldoburgojunior.myclassv1.Custom.DividerItemDecoration;
import com.example.agnaldoburgojunior.myclassv1.Models.Disciplina;
import com.example.agnaldoburgojunior.myclassv1.R;

import java.util.List;

/**
 * Created by Agnaldo.Burgo.Junior on 25/03/2016.
 */
public class MinhasDisciplinasFragment extends Fragment {

    com.github.clans.fab.FloatingActionButton novo;
    RecyclerView mRecyclerView;
    List<Disciplina> mList;

    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_minhas_disciplinas, container, false);

        novo = (com.github.clans.fab.FloatingActionButton) v.findViewById(R.id.nova_disciplina);
        mRecyclerView = (RecyclerView) v.findViewById(R.id.list_disciplina);

        novo.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(getContext(), DisciplinaView.class);
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

        DisciplinaDAO t = new DisciplinaDAO();
        mList = t.selectTodosDisciplina();

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
                DisciplinaAdapter adp = (DisciplinaAdapter) mRecyclerView.getAdapter();

                if (mList.size() == llm.findFirstCompletelyVisibleItemPosition() + 1) {
                    DisciplinaDAO t = new DisciplinaDAO();

                    List<Disciplina> listAux = t.selectTodosDisciplina();


                    for (int i = 0; i < listAux.size(); i++) {
                        adp.addListItem(listAux.get(i), mList.size());
                    }
                }
            }
        });

        LinearLayoutManager llm = new LinearLayoutManager(getContext());
        llm.setOrientation(LinearLayoutManager.VERTICAL);
        mRecyclerView.setLayoutManager(llm);

        mList = t.selectTodosDisciplina();
        DisciplinaAdapter adp = new DisciplinaAdapter(getContext(), mList);

        adp.setRecyclerViewOnClickListenerHack(new RecyclerViewOnClickListenerHack() {
            @Override
            public void onClickListener(View view, int position) {

                Intent myIntent = new Intent(getContext(), DisciplinaView.class);
                Bundle b = new Bundle();
                b.putInt("cod", mList.get(position).getCoddisciplina());
                b.putBoolean("visibilidade",true);
                myIntent.putExtras(b);
                startActivity(myIntent);

            }
        });
        mRecyclerView.addItemDecoration(new DividerItemDecoration(getContext(), LinearLayoutManager.VERTICAL));
        mRecyclerView.setAdapter(adp);



    }
}
