<?

    pg_connect("host=localhost user=pgsql password=Ocarinas dbname=".$_GET[dbname]." port=5432");

    pg_query("GRANT ALL ON ".$_GET[table]." to internet");

?>
