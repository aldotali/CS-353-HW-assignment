import java.sql.*;
import java.text.SimpleDateFormat;

public class Tester {
	public static void main(String[] args){
		
		//use this for the connection in the server DB_NAME : aldo_tali
        String url = "jdbc:mysql://dijkstra.ug.bcc.bilkent.edu.tr/aldo_tali";
        
        try{
            Class.forName("com.mysql.jdbc.Driver");
            Connection connection = DriverManager.getConnection( url + "?user=user&password=pass");
            Statement stmt = connection.createStatement(); 
            
            //clear the environment. Note that apply should be deleted before 
            //because if it is left to be deleted last then some dependency problems on special cases might occur
            stmt.executeUpdate("DROP TABLE IF EXISTS apply");
            stmt.executeUpdate("DROP TABLE IF EXISTS student");
            stmt.executeUpdate("DROP TABLE IF EXISTS company");
           
            /*
             * student(sid: CHAR(12), sname: VARCHAR(50), bdate: DATE, address: VARCHAR(50), 
             * scity: VARCHAR(20), year: CHAR(20), gpa: FLOAT, nationality: VARCHAR(20))
             */
            stmt.executeUpdate( "CREATE TABLE student(" +
            				    "sid CHAR(12)," +  
            				    "sname VARCHAR(50)," +
            				    "bdate DATE," +
            				    "adress VARCHAR(50)," +
                                "scity VARCHAR(20)," +
                                "year CHAR(20)," +
                                "gpa FLOAT," +
                                "nationality VARCHAR(20)," +
            				    "PRIMARY KEY(sid) ) ENGINE=innodb;");

            
            /*company(cid: CHAR(8), cname: VARCHAR(20), quota: INT)*/
            stmt.executeUpdate("CREATE TABLE company" +
            				    "(cid CHAR(8)," +  
                                "cname VARCHAR(20)," +
                                "quota INT," +
            				    "PRIMARY KEY(cid) ) ENGINE=innodb;");
            
           
           /*apply(sid: CHAR(12), cid: CHAR(8))*/
            stmt.executeUpdate("CREATE TABLE apply" +
				    "(sid CHAR(12)," +  
                    "cid CHAR(8)," +
                    "PRIMARY KEY(sid,cid)," +
                    "FOREIGN KEY (sid) REFERENCES student(sid), "
                    + "FOREIGN KEY (cid) REFERENCES company(cid))" + "ENGINE=innodb;");
            
		    //populate with data
            stmt.executeUpdate("INSERT INTO student VALUES (21000001,'Ayse', '1995-05-10' ,'Tunali','Ankara','senior',2.75, 'TC');");
            stmt.executeUpdate("INSERT INTO student VALUES (21000002,'Ali','1997-09-12','Nisantasi','Istanbul','junior',3.44, 'TC');");
            stmt.executeUpdate("INSERT INTO student VALUES (21000003,'Ayse','1998-10-25','Nisantasi','Istanbul','senior',2.36, 'TC');");
            stmt.executeUpdate("INSERT INTO student VALUES (21000004,'John','1999-01-15','Windy','Chicago','freshmen',3.44, 'TC');");

            stmt.executeUpdate("INSERT INTO company VALUES ('CS101','tubitak',2)");
            stmt.executeUpdate("INSERT INTO company VALUES ('CS102','aselsan',5)");
            stmt.executeUpdate("INSERT INTO company VALUES ('CS103','havelsan',3)");
            stmt.executeUpdate("INSERT INTO company VALUES ('CS104','microsoft',5)");
            stmt.executeUpdate("INSERT INTO company VALUES ('CS105','merkez bankasi',3)");
            stmt.executeUpdate("INSERT INTO company VALUES ('CS106','tai',4)");
            stmt.executeUpdate("INSERT INTO company VALUES ('CS107','milsoft',2)") ;

            stmt.executeUpdate("INSERT INTO apply VALUES (21000001,'CS101')");
            stmt.executeUpdate("INSERT INTO apply VALUES (21000001,'CS102')");
            stmt.executeUpdate("INSERT INTO apply VALUES (21000001,'CS103')");
            stmt.executeUpdate("INSERT INTO apply VALUES (21000002,'CS101')");
            stmt.executeUpdate("INSERT INTO apply VALUES (21000002,'CS105')");
            stmt.executeUpdate("INSERT INTO apply VALUES (21000003,'CS104')");
            stmt.executeUpdate("INSERT INTO apply VALUES (21000003,'CS105')");
            stmt.executeUpdate("INSERT INTO apply VALUES (21000004,'CS107')");

            
            System.out.println("Sid" +"\t"+ "sname"+"\t"+ "bdate"+"\t"+ "adress"+ "scity"+"\t"+ "year"+"\t" +"gpa"+ "\t" + "nationality");
            //stmt.executeUpdate("SELECT * FROM student");
            /*Execute the command �SELECT * FROM student� and print the results on screen.*/
            ResultSet cursor = stmt.executeQuery("SELECT * FROM student");
            while (cursor.next()) {
            	 int id  = cursor.getInt("sid");
            	 String sname  = cursor.getString("sname");
            	 Date bdate  = cursor.getDate( "bdate");
            	 String adress  = cursor.getString("adress");
            	 String scity  = cursor.getString("scity");
            	 String year  = cursor.getString("year");
            	 String gpa  = cursor.getString("gpa");
            	 String nationality  = cursor.getString("nationality");
            	 
                 System.out.println(id + "\t" + sname + "\t" + bdate + "\t" + adress + "\t" + scity + "\t" + year + "\t" + gpa + "\t" + nationality + "\t");
            }
        } catch (ClassNotFoundException e) {
        	System.out.println("Could not connect to the jdbc driver " + e);
		} catch (SQLException e) {
	 		System.out.println("Could not query the file " + e);
		}
        
	}
}
