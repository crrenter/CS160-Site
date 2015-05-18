import java.io.IOException;

//import javax.lang.model.util.Elements;
import java.sql.*;
import java.util.ArrayList;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;


public class JsoupTest {
	public static void main (String args[]) throws IOException, InstantiationException, IllegalAccessException, ClassNotFoundException, SQLException{
		Class.forName("com.mysql.jdbc.Driver");
		String url = "jdbc:mysql://localhost/test";
		String user = "root";
		String password = "";
		int j=0;
		java.sql.Connection connection = DriverManager.getConnection(url,user,password);
		Statement str = connection.createStatement();
		ArrayList<String> sites = new ArrayList<String>();
		ArrayList<InteractiveSite> finish = new ArrayList<InteractiveSite>();
		/* ADD ALL SITES TO ARRAY*/
		sites.add("http://www.internet4classrooms.com/links_grades_kindergarten_12/astronomy_general.htm");
		sites.add("http://www.internet4classrooms.com/links_grades_kindergarten_12/astronomy_near_earth.htm");
		sites.add("http://www.internet4classrooms.com/links_grades_kindergarten_12/astronomy_solar_system.htm");
		sites.add("http://www.internet4classrooms.com/links_grades_kindergarten_12/astronomy_stars_galaxies.htm");
		sites.add("http://www.internet4classrooms.com/biology.htm");
		sites.add("http://www.internet4classrooms.com/earthspace.htm");
		sites.add("http://www.internet4classrooms.com/science_elem_animals.htm");
		sites.add("http://www.internet4classrooms.com/science_elem_earth.htm");
		sites.add("http://www.internet4classrooms.com/science_elem_force.htm");
		sites.add("http://www.internet4classrooms.com/science_elem_general.htm");
		sites.add("http://www.internet4classrooms.com/science_elem_machines.htm");
		sites.add("http://www.internet4classrooms.com/science_elem_magnets.htm");
		sites.add("http://www.internet4classrooms.com/science_elem_plants.htm");
		sites.add("http://www.internet4classrooms.com/science_elem_sound.htm");
		sites.add("http://www.internet4classrooms.com/science_elem_space.htm");
		sites.add("http://www.internet4classrooms.com/science_elem_weather.htm");
		sites.add("http://www.internet4classrooms.com/physics.htm");
		sites.add("http://www.internet4classrooms.com/assessment_assistance/physics_standards_mechanics.htm");
		sites.add("http://www.internet4classrooms.com/assessment_assistance/physics_standards_thermodynamics.htm");
		sites.add("http://www.internet4classrooms.com/assessment_assistance/physics_standards_waves_and_sound.htm");
		sites.add("http://www.internet4classrooms.com/assessment_assistance/physics_standards_light_and_optics.htm");
		sites.add("http://www.internet4classrooms.com/assessment_assistance/physics_standards_electricity_and_magnetism.htm");
		sites.add("http://www.internet4classrooms.com/assessment_assistance/physics_standards_nuclear_physics.htm");
		/* Grab all the Li tags in the site*/
		for(String a: sites){

			Document doc = Jsoup.connect(a).get();

			Elements links = doc.select("li");
			for(Element src : links){
				if(src.getElementsByTag("img").attr("src").equals("/images/icon-interactive.gif") ){
					InteractiveSite temp = new InteractiveSite(src.select("a[href]").text(),src.text(),doc.select("h2").first().text(),"K,1,2,3,4,5,6,7,8,9,10,11,12",src.getElementsByTag("img").attr("src"),src.getElementsByTag("a").attr("href"));
					finish.add(temp);

				}
			}
		}

		/*Make sure to delete any outer Lists records since they are already included*/
		Document chemDoc = Jsoup.connect("http://www.internet4classrooms.com/chemistry.htm").get();
		Elements links = chemDoc.getElementsByTag("img");
		for (Element link : links) {
			String linkText = link.attr("src");
			if (linkText.equals("/images/icon-interactive.gif")) {

				InteractiveSite temp = new InteractiveSite(link.parent().select("a[href]").text(),link.parent().text(),"Chemistry","K,1,2,3,4,5,6,7,8,9,10,11,12",link.attr("src"),link.previousElementSibling().attr("href"));
				finish.add(temp);
			}
		}

		for(InteractiveSite a: finish){
			if(a.getCategory().equals("General Astronomy") || a.getCategory().equals("Near Earth Astronomy")){
				a.setCategory("Astronomy- "+a.getCategory());
			}
			if(a.getCategory().equals("Astronomy: Stars and Galaxies")){
				a.setCategory("Astronomy- Stars and Galaxies");
			}
			if(a.getCategory().equals("Solar System Resources")){
				a.setCategory("Astronomy- Solar System");
			}
			if (a.getCategory().equals("Electricity for Elementary Science")){
				a.setCategory("Elementary Science- Electricity");
			}
			if (a.getCategory().equals("General Science for Elementary Classes")){
				a.setCategory("Elementary Science- General Science");
			}
			if (a.getCategory().equals("SImple Machines - Elementary Science")){
				a.setCategory("Elementary Science- Simple Machines");
			}
			if (a.getCategory().equals("Magnets for Elementary Science")){
				a.setCategory("Elementary Science- Magnets");
			}
			if (a.getCategory().equals("Plants Elementary Science")){
				a.setCategory("Elementary Science- Plants");
			}
			if (a.getCategory().equals("Sound - Elementary Science")){
				a.setCategory("Elementary Science- Sound");
			}
			if (a.getCategory().equals("Space Sites for Elementary Science")){
				a.setCategory("Elementary Science- Space");
			}
			if (a.getCategory().equals("Weather for Elementary Science")){
				a.setCategory("Elementary Science- Weather");
			}
			String create = "INSERT INTO EDUCATION VALUES("+ (++j)+",'"+a.getTitle().replaceAll("\"|'","\"" )+"','"+a.getDescription().replaceAll("\"|'","`" )+
					"','"+a.getLink()+"','"+""+"','"+a.getCategory().replaceAll("-", "/") + "','" +a.getTargetStudents()+"','"+a.getAuthor()+"','"
					+a.getContentType()+"',CURRENT_TIMESTAMP)";

			str.execute(create);
			a.print();
		}
		str.close();
		connection.close();
	}
}
