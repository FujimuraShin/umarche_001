
//20210407-1111
//Android HttpURLConnectionについて
//参考サイト
//https://qiita.com/mainvoidllll/items/a29ca2a8c50e3c7e80bd

public String getGET() throws IOException{

    final int CONNECTINO_TIMEOUT=30*1000;
    final int READ_TIMEOUT=30*1000;

    URL url=new URL("");

    HttpURLConnection conn=(HttpURLConnection) url.openConnection();
    conn.setConnectionTimeout(CONNECTION_TIMEOUT);
    conn.setReadTimeout(READ_TIMEOUT);
    
    conn.setRequestMethod("GET");
    conn.connect();

    int statusCode=conn.getResponseCode();

    if(statudCode==HttpURLConnection.HTTP_OK){
        StringBuffer result=null;

        //responseの読み込み
        //InputStreamからテキストを読み込めば、jsonやxmlなどのデータを取得できる。
        final InputStream in=conn.getInputStream();
        final String encoding=conn.getContentEncoding();
        final InputStreamReader inReader=new InputStreamReader(in,encoding);
        final BufferedReader bufferedReader=new BufferedReader(inReader);
        Sting line=null;

        while((line=bufferedReader.readLine())!=null){
            result.append(line);
        }

        bufferedReader.close();
        inReader.close();
        in.close();

        return result.toString();
    }

    return null;
}

public class TestHttp extends AsyncTask<Void,Void,Void>{

    protected Void doInBackground(Void... params){
        try{
            getGet();
        }catch(IOException e){
            e.printStackTrace();
        }

        return null;
    }
}