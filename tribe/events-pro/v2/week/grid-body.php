<?php
/**
 * View: Week View - Grid Body
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events-pro/v2/week/grid-body.php
 *
 * See more documentation about our views templating system.
 *
 * @link https://evnt.is/1aiy
 *
 * @version 5.0.0
 *
 * @var array $multiday_events     An array of each day multi-day events and more event count, if any, in the shape
 *                                 `[ <Y-m-d> => [ 'events' => [ ...$multiday_events], 'more_events' => <int> ] ]`.
 * @var bool  $has_multiday_events Boolean whether the week has multiday events or not.
 * @var array $events              An array of each day non multi-day events, if any, in the shape `[ <Y-m-d> => [ ...$events ] ]`.
 * @var array $days                An array of days with additional data.
 */
?>

<?php
use Tribe__Date_Utils as Dates;
use Tribe__Events__Timezones as Timezones;

$all_events = [];

?>

<div class="tribe-events-pro-week-grid__body" role="rowgroup">

	<?php if ( count( $multiday_events ) && $has_multiday_events ) : ?>

		<?php foreach ( $multiday_events as $day => list( $day_multiday_events, $more_events ) ) : ?>
				<?php foreach ( $day_multiday_events as $event ) : ?>
					<?php $this->setup_postdata( $event ); ?>
					<?php
					$start = Timezones::is_mode( 'site' ) ? $event->dates->start_site : $event->dates->start;
					$start_time = Dates::time_between( $start->format( 'Y-m-d 0:0:0' ), $start->format( Dates::DBDATETIMEFORMAT ) );
					?>
					<?php $all_events[$day][$start_time] = $event ?>
				<?php endforeach; ?>
		<?php endforeach; ?>

	<?php endif; ?>



	<?php foreach ( $events as $day => $events ) : ?>
		<?php foreach ( $events as $event ) : ?>
			<?php $this->setup_postdata( $event ); ?>
			<?php
			$start = Timezones::is_mode( 'site' ) ? $event->dates->start_site : $event->dates->start;
			$start_time = Dates::time_between( $start->format( 'Y-m-d 0:0:0' ), $start->format( Dates::DBDATETIMEFORMAT ) );
			?>
			<?php $all_events[$day][$start_time] = $event ?>
		<?php endforeach; ?>
	<?php endforeach; ?>

	<?php
	ksort($all_events);

	foreach( $all_events as $day => $start_time ) {

		$date = date_create( $day );
		printf( '<h4>%s</h4>', date_format($date , 'l, F j' ) );
		
		ksort($start_time);

		foreach( $start_time as $_event ) {
			$this->template( 'list/event', [ 'event' => $_event ] );
		}
	}
	?>			