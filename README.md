# Heketon
Software for monitoring energy usage in office buildings. 

## Parts
- Frontend: Svelte
- Backend: PHP, Workerman, Cycle ORM
- Hardware: Klimatizace, Žárovky, Topení, Otevřená okna, ...

## Documentation
The project is designed for the Brno magistrate. In the project we are handling multiple systems and are trying to design a simple and user-friendly interface. The solution is supposed to help magistrate save money on energy costs and also reduce their carbon footprint.

We gather data from a lot of systems. We collect the temperature of a given room, the lighting level in a given room and the amount of people in the given room. We accomplish this with multitude of sensors and a chip reader where the employees must sign to enter the room. With this data we can control the temperature in the room and with access to calendar with what is going to happen in the room, then we can turn the heating/cooling off if no one is in the room and won't be there for extended amount of time. With smart blinds and lights we can minimise the amount of wasted energy by lights when there can be light from the sun. We also turn off the lights in the room if no one is present.

To use, collect and move all this data we are building a reliable back-end. We are aiming for a back-end that is quick, secure and reliable. We see the risk of having all the systems of the building being controlled remotely and possibly even off-site. Because of this we are focusing on encryption and security to minimise any possibility of a breach. 

We believe that our solution would be beneficial to the Brno magistrate and we believe that our solution is better then any alternative on the market due to the fact it was hand-tailored to suit their needs. We also believe that we should reach higher energy and therefore cost saving then our competitors. This is due to the fact we base must of our smart technology around this and we also have some improvements to help us save more. One of these could include our system that automatically detects an open window and does not waste energy heating or cooling a room with an open window unless it is specifically told to do otherwise. Also if a room has been completely left and the windows are open the building administrator will be notified.

Because the building will have solar panels installed we are going to use our software to control the amount of heating and cooling we are doing based on the output of these panels. We are going to increase the cooling and heating in the rooms where there are the most people and if we have enough energy we are going to preheat/precool the rooms where there are no people to avoid wasting any energy. We also plan to incorporate the cheap and expensive cycles of electricity and reduce cooling and heating when it is expensive and increase it when it is cheap. These two systems working together will ensure the cheapest way possible to cool and heat the building.

All of our features can be seen and used from our website. The user can log into his account by the credentials given to him by his employer. On the website we can select any room and view the rooms temperature, the amount of people that are in there (not who), the light level and if the room has windows open. We can then configure the desired temperature and light level. We can also override the open window check if we wish to do so.

In the app the user can also view various graphs and statistics. These can be the average temperatures in a room during the day or the amount of synthetic lighting in a given room. Or he can view the statistics for the whole floor or even for the whole building. The stats that the user can view also include the stats of the costs for electricity during the day.

The building administrator or any one who is authorised to do so can edit the room names and can change the permissions of each user to view certain rooms or to change the temperature and light level in them. They can also select which rooms the user has access to via his chip.

In summary we strongly believe that our solution would be best for the Brno magistrate because it is hand tailored to them. This will be beneficial for them because if they do not like something in the app or with how something works it can be easily changed to work for them. Our solution is also the best because we provide them with only what they need so they will end up saving money in the short and long term. Our solution is also the most focused on saving money on energy and the most Eco-friendly.
