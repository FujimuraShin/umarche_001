
public class MainActivity extends AppCompactActity{

    private UploadTask task;
    private TextView textView;
    //wordを入れる
    private EditText editText;

    //phpがPOSTで受けっとったwordを入れて作成するHTMLページ
    String url="http://hoge-hoge.com/pass_check.html";

    protected void onCreate(Bundle savedInstanceState){
        super.onCreate(savedInstanceState);
        setContentView(R.layout.acitiviy_main);

        editText=findViewById(R.id.uriname);

        Button post=findViewById(R.id.post);

        post.setOnClickListener(new View.OnClickListener(){

            public void onClick(View v){
                String param0=editText.getText().toString();

                if(param0.length()!=0){
                    task=new UploadTask();
                    task.setListener(createListener());
                    task.execute(param0);
                }
            }
        });

        //ブラウザを起動する
        Button browser=findViewById(R.id.browser);
        browser.setOnClickListener(new View.OnClickListener(){
            public void onClick(View v){
                Uri uri=Uri.parser(url);
                Intent intent=new Intent(Intent.ACTION_VIEW,uri);
                startAcitivity(intent);

                //text clear
                textView.setText("");
            }
        })
    }
}