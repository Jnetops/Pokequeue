<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;
use File;

class CreateGroup extends Notification
{
    use Queueable;

    protected $groupCreate;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($groupCreate)
    {
        $this->groupCreate = $groupCreate;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

      $typeArray = array();
      // sets up statements for notifications based on types

      // if type 1, gym battles
      if ($this->groupCreate->type == 1)
      {
        $typeArray['type'] = 'Gym Battles: ';
        if ($this->groupCreate->subType1 == 1)
        {
          $typeArray['subType1'] = 'Mystic';
        }
        elseif ($this->groupCreate->subType1 == 2)
        {
          $typeArray['subType1'] = 'Valor';
        }
        else {
          $typeArray['subType1'] = 'Instinct';
        }
      }
      // if type 2, pokemon farming
      elseif ($this->groupCreate->type == 2)
      {
        $typeArray['type'] = 'Pokemon Farming: ';
        if ($this->groupCreate->subType1 == 1)
        {
          $typeArray['subType1'] = 'Event Farm';
        }
        elseif ($this->groupCreate->subType1 == 2)
        {
          $pokemonList = array("BULBASAUR" => 1, "IVYSAUR" => 2, "VENUSAUR" => 3,"CHARMANDER" => 4,"CHARMELEON" => 5,"CHARIZARD" => 6,"SQUIRTLE" => 7,"WARTORTLE" => 8,"BLASTOISE" => 9,"CATERPIE" => 10,"METAPOD" => 11,"BUTTERFREE" => 12,"WEEDLE" => 13,"KAKUNA" => 14,"BEEDRILL" => 15,"PIDGEY" => 16,"PIDGEOTTO" => 17,"PIDGEOT" => 18,"RATTATA" => 19,"RATICATE" => 20,"SPEAROW" => 21,"FEAROW" => 22,"EKANS" => 23,"ARBOK" => 24,"PIKACHU" => 25,"RAICHU" => 26,"SANDSHREW" => 27,"SANDSLASH" => 28,"NIDORAN_FEMALE" => 29,"NIDORINA" => 30,"NIDOQUEEN" => 31,"NIDORAN_MALE" => 32,"NIDORINO" => 33,"NIDOKING" => 34,"CLEFAIRY" => 35,"CLEFABLE" => 36,"VULPIX" => 37,"NINETALES" => 38,"JIGGLYPUFF" => 39,"WIGGLYTUFF" => 40,"ZUBAT" => 41,"GOLBAT" => 42,"ODDISH" => 43,"GLOOM" => 44,"VILEPLUME" => 45,"PARAS" => 46,"PARASECT" => 47,"VENONAT" => 48,"VENOMOTH" => 49,"DIGLETT" => 50,"DUGTRIO" => 51,"MEOWTH" => 52,"PERSIAN" => 53,"PSYDUCK" => 54,"GOLDUCK" => 55,"MANKEY" => 56,"PRIMEAPE" => 57,"GROWLITHE" => 58,"ARCANINE" => 59,"POLIWAG" => 60,"POLIWHIRL" => 61,"POLIWRATH" => 62,"ABRA" => 63,"KADABRA" => 64,"ALAKAZAM" => 65,"MACHOP" => 66,"MACHOKE" => 67,"MACHAMP" => 68,"BELLSPROUT" => 69,"WEEPINBELL" => 70,"VICTREEBEL" => 71,"TENTACOOL" => 72,"TENTACRUEL" => 73,"GEODUDE" => 74,"GRAVELER" => 75,"GOLEM" => 76,"PONYTA" => 77,"RAPIDASH" => 78,"SLOWPOKE" => 79,"SLOWBRO" => 80,"MAGNEMITE" => 81,"MAGNETON" => 82,"FARFETCHD" => 83,"DODUO" => 84,"DODRIO" => 85,"SEEL" => 86,"DEWGONG" => 87,"GRIMER" => 88,"MUK" => 89,"SHELLDER" => 90,"CLOYSTER" => 91,"GASTLY" => 92,"HAUNTER" => 93,"GENGAR" => 94,"ONIX" => 95,"DROWZEE" => 96,"HYPNO" => 97,"KRABBY" => 98,"KINGLER" => 99,"VOLTORB" => 100,"ELECTRODE" => 101,"EXEGGCUTE" => 102,"EXEGGUTOR" => 103,"CUBONE" => 104,"MAROWAK" => 105,"HITMONLEE" => 106,"HITMONCHAN" => 107,"LICKITUNG" => 108,"KOFFING" => 109,"WEEZING" => 110,"RHYHORN" => 111,"RHYDON" => 112,"CHANSEY" => 113,"TANGELA" => 114,"KANGASKHAN" => 115,"HORSEA" => 116,"SEADRA" => 117,"GOLDEEN" => 118,"SEAKING" => 119,"STARYU" => 120,"STARMIE" => 121,"MR_MIME" => 122,"SCYTHER" => 123,"JYNX" => 124,"ELECTABUZZ" => 125,"MAGMAR" => 126,"PINSIR" => 127,"TAUROS" => 128,"MAGIKARP" => 129,"GYARADOS" => 130,"LAPRAS" => 131,"DITTO" => 132,"EEVEE" => 133,"VAPOREON" => 134,"JOLTEON" => 135,"FLAREON" => 136,"PORYGON" => 137,"OMANYTE" => 138,"OMASTAR" => 139,"KABUTO" => 140,"KABUTOPS" => 141,"AERODACTYL" => 142,"SNORLAX" => 143,"ARTICUNO" => 144,"ZAPDOS" => 145,"MOLTRES" => 146,"DRATINI" => 147,"DRAGONAIR" => 148,"DRAGONITE" => 149,"MEWTWO" => 150,"MEW" => 151,"CHIKORITA" => 152,"BAYLEEF" => 153,"MEGANIUM" => 154,"CYNDAQUIL" => 155,"QUILAVA" => 156,"TYPHLOSION" => 157,"TOTODILE" => 158,"CROCONAW" => 159,"FERALIGATR" => 160,"SENTRET" => 161,"FURRET" => 162,"HOOTHOOT" => 163,"NOCTOWL" => 164,"LEDYBA" => 165,"LEDIAN" => 166,"SPINARAK" => 167,"ARIADOS" => 168,"CROBAT" => 169,"CHINCHOU" => 170,"LANTURN" => 171,"PICHU" => 172,"CLEFFA" => 173,"IGGLYBUFF" => 174,"TOGEPI" => 175,"TOGETIC" => 176,"NATU" => 177,"XATU" => 178,"MAREEP" => 179,"FLAAFFY" => 180,"AMPHAROS" => 181,"BELLOSSOM" => 182,"MARILL" => 183,"AZUMARILL" => 184,"SUDOWOODO" => 185,"POLITOED" => 186,"HOPPIP" => 187,"SKIPLOOM" => 188,"JUMPLUFF" => 189,"AIPOM" => 190,"SUNKERN" => 191,"SUNFLORA" => 192,"YANMA" => 193,"WOOPER" => 194,"QUAGSIRE" => 195,"ESPEON" => 196,"UMBREON" => 197,"MURKROW" => 198,"SLOWKING" => 199,"MISDREAVUS" => 200,"UNOWN" => 201,"WOBBUFFET" => 202,"GIRAFARIG" => 203,"PINECO" => 204,"FORRETRESS" => 205,"DUNSPARCE" => 206,"GLIGAR" => 207,"STEELIX" => 208,"SNUBBULL" => 209,"GRANBULL" => 210,"QWILFISH" => 211,"SCIZOR" => 212,"SHUCKLE" => 213,"HERACROSS" => 214,"SNEASEL" => 215,"TEDDIURSA" => 216,"URSARING" => 217,"SLUGMA" => 218,"MAGCARGO" => 219,"SWINUB" => 220,"PILOSWINE" => 221,"CORSOLA" => 222,"REMORAID" => 223,"OCTILLERY" => 224,"DELIBIRD" => 225,"MANTINE" => 226,"SKARMORY" => 227,"HOUNDOUR" => 228,"HOUNDOOM" => 229,"KINGDRA" => 230,"PHANPY" => 231,"DONPHAN" => 232,"PORYGON2" => 233,"STANTLER" => 234,"SMEARGLE" => 235,"TYROGUE" => 236,"HITMONTOP" => 237,"SMOOCHUM" => 238,"ELEKID" => 239,"MAGBY" => 240,"MILTANK" => 241,"BLISSEY" => 242,"RAIKOU" => 243,"ENTEI" => 244,"SUICUNE" => 245,"LARVITAR" => 246,"PUPITAR" => 247,"TYRANITAR" => 248,"LUGIA" => 249,"HO_OH" => 250,"CELEBI" => 251);

          foreach ($pokemonList as $pokemonKey => $pokemonValue)
          {
            if ($pokemonValue == $this->groupCreate->subType2)
            {
              $typeArray['subType2'] = $pokemonKey;
            }
          }
        }
        elseif ($this->groupCreate->subType1 == 3) {
          $typeArray['subType1'] = 'Any/All';
        }
      }
      // if type 3, item farming
      elseif ($this->groupCreate->type == 3) {
          $typeArray['type'] = 'Item Farming';
      }

      elseif ($this->groupCreate->type == 4) {

        $path = public_path() . '/protos/pokemon.json';// ie: /var/www/laravel/app/storage/json/filename.json
        if (!File::exists($path)) {
            return 'failed';
        }

        $file = File::get($path); // string
        $file = json_decode($file, true);

        $pokemonArray = array();
        foreach ($file as $poke)
        {
          if ($poke['Number'] == $this->groupCreate->subType2)
          {
            $pokeName = $poke['Name'];
          }
        }

        $typeArray['type'] = $this->groupCreate->subType1 . ' Star ' . $pokeName . ' Raid';
      }

      $eventArray = ['group' => ['user' => $this->groupCreate->admin,
                      'statement' => ' Has Created a Group for ',
                      'types' => $typeArray,
                      'group_id' => $this->groupCreate->id]
                    ];
      return $eventArray;
    }
}
