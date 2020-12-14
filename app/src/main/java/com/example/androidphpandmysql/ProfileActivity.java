package com.example.androidphpandmysql;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.TextView;
import android.widget.Toast;

public class ProfileActivity extends AppCompatActivity {
    private TextView tv_username, tv_email;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);

        if(!SharedPrefManager.getInstance(this).isLoggedIn()){ // if user is not logged in
            finish();
            startActivity(new Intent(this, Login.class));
        }

        tv_username = (TextView)findViewById(R.id.tv_username_txt);
        tv_email = (TextView)findViewById(R.id.tv_email_txt);

        tv_email.setText(SharedPrefManager.getInstance(this).getUserEmail());
        tv_username.setText(SharedPrefManager.getInstance(this).getUserName());
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(@NonNull MenuItem item) {

        switch (item.getItemId()){
            case R.id.menuLogout:
                SharedPrefManager.getInstance(this).logout();
                finish();
                startActivity(new Intent(this, Login.class));
                break;

            case R.id.menuUpdate:
                Toast.makeText(this, "Updated", Toast.LENGTH_LONG).show();
                break;
        }
        return true;
    }
}