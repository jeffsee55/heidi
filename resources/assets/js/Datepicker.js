var React = require('react');
var ReactDOM = require('react-dom');
import moment from 'moment';
import { DateRangePicker } from 'react-dates';
import { DayPicker } from 'react-dates';

class Q4DayPicker extends DayPicker
{
}

class Q4DateRangePicker extends DateRangePicker
{
    renderDayPicker() {
        const {
            isDayBlocked,
            isOutsideRange,
            isCheckinUnavailable,
            isCheckoutUnavailable,
            numberOfMonths,
            orientation,
            monthFormat,
            navPrev,
            navNext,
            onPrevMonthClick,
            onNextMonthClick,
            withPortal,
            withFullScreenPortal,
            enableOutsideDays,
            initialVisibleMonth,
            focusedInput,
        } = this.props;
        const { dayPickerContainerStyles } = this.state;

        const modifiers = {
            blocked: day => this.isBlocked(day),
            'blocked-calendar': day => isDayBlocked(day),
            'blocked-checkin': day => isCheckinUnavailable(day),
            'blocked-checkout': day => isCheckoutUnavailable(day),
            'blocked-out-of-range': day => isOutsideRange(day),
            'blocked-minimum-nights': day => this.doesNotMeetMinimumNights(day),
            valid: day => !this.isBlocked(day),
            // before anything has been set or after both are set
            hovered: day => this.isHovered(day),

            // while start date has been set, but end date has not been
            'hovered-span': day => this.isInHoveredSpan(day),
            'after-hovered-start': day => this.isDayAfterHoveredStartDate(day),
            'last-in-range': day => this.isLastInRange(day),

            // once a start date and end date have been set
            'selected-start': day => this.isStartDate(day),
            'selected-end': day => this.isEndDate(day),
            'selected-span': day => this.isInSelectedSpan(day),
        };

        const onOutsideClick = !withFullScreenPortal ? this.onOutsideClick : undefined;

        return (
            <div
            ref={ref => { this.dayPickerContainer = ref; }}
            className={this.getDayPickerContainerClasses()}
            style={dayPickerContainerStyles}
            >
            <DayPicker
            ref={ref => { this.dayPicker = ref; }}
            orientation={orientation}
            enableOutsideDays={enableOutsideDays}
            modifiers={modifiers}
            numberOfMonths={numberOfMonths}
            onDayMouseEnter={this.onDayMouseEnter}
            onDayMouseLeave={this.onDayMouseLeave}
            onDayMouseDown={this.onDayClick}
            onDayTouchTap={this.onDayClick}
            onPrevMonthClick={onPrevMonthClick}
            onNextMonthClick={onNextMonthClick}
            monthFormat={monthFormat}
            withPortal={withPortal || withFullScreenPortal}
            hidden={!focusedInput}
            initialVisibleMonth={initialVisibleMonth}
            onOutsideClick={onOutsideClick}
            navPrev={navPrev}
            navNext={navNext}
            />

            {withFullScreenPortal &&
                <button
                className="DateRangePicker__close"
                type="button"
                onClick={this.onOutsideClick}
                >
                <span className="screen-reader-only">
                {this.props.phrases.closeDatePicker}
                </span>
                <CloseButton />
                </button>
            }
            </div>
        );
    }
}

class DateRangePickerWrapper extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            className: null,
            focusedInput: null,
            startDate: null,
            endDate: null,
            displayFormat: 'MM-DD-YYYY',
            numberOfMonths: 2,
            withPortal: false,
            enableOutsideDays: false,
            unavailableDates: [],
            checkinUnavailable: [],
            checkoutUnavailable: [],
            minimumNights: 0
        };

        this.getParam = this.getParam.bind(this);
        this.setStartDate = this.setStartDate.bind(this);
        this.setEndDate = this.setEndDate.bind(this);
        this.onDatesChange = this.onDatesChange.bind(this);
        this.onFocusChange = this.onFocusChange.bind(this);
        this.isDayBlocked= this.isDayBlocked.bind(this);
        this.isCheckinUnavailable = this.isCheckinUnavailable.bind(this)
        this.isCheckoutUnavailable = this.isCheckoutUnavailable.bind(this)
        this.setResponsiveness = this.setResponsiveness.bind(this);
    }

    getParam(name) {
        var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
        return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
    }

    setStartDate() {
        var startDate = this.getParam('startDate');
        if(startDate) {
            this.setState({startDate: moment(startDate)});
        }
    }

    setEndDate() {
        var endDate = this.getParam('endDate');
        if(endDate) {
            this.setState({endDate: moment(endDate)});
        }
    }

    onDatesChange({ startDate, endDate }) {
        this.setState({ startDate, endDate });
    }

    onFocusChange(focusedInput) {
        this.setState({ focusedInput });
    }

    setResponsiveness(e) {
        if(window.innerWidth < '720') {
            this.setState({ numberOfMonths: 1 });
            this.setState({ withPortal: true });
            this.setState({ enableOutsideDays: true });
        } else {
            this.setState({ numberOfMonths: 2 });
            this.setState({ withPortal: false });
            this.setState({ enableOutsideDays: false });
        }
    }

    componentWillMount() {
        this.setStartDate();
        this.setEndDate();
        this.setResponsiveness();
        this.setState({ className: '' });
    }

    componentDidMount() {
        window.addEventListener("resize", this.setResponsiveness);
        var unitInput = document.getElementById('unitCode');
        if(unitInput) {
            var unitCode = unitInput.value;
            jQuery.ajax({
                url: `/wp-admin/admin-ajax.php?action=q4vr_calendar&unit_code=${unitCode}`,
                dataType: 'json',
                cache: false,
                success: function(results) {
                    this.setState({checkinUnavailable: results.data.checkin_unavailable});
                    this.setState({checkoutUnavailable: results.data.checkout_unavailable});
                    this.setState({unavailableDates: results.data.unavailable});
                    this.setState({minimumNights: 3});
                }.bind(this),
                error: function(xhr, status, err) {
                    console.error(this.props.url, status, err.toString());
                }.bind(this)
            });
            var startDate = document.getElementById("startDate");
            var endDate = document.getElementById("endDate");
            startDate.setAttribute("required", true);
            endDate.setAttribute("required", true);
            // run the availability search on page load
            if(startDate.value && endDate.value) {
                document.getElementById("searchSubmit").click();
            }
        }
    }

    isCheckinUnavailable(day) {
        return this.state.checkinUnavailable.includes(day.format('YYYY-MM-DD'));
    }

    isCheckoutUnavailable(day) {
        return this.state.checkoutUnavailable.includes(day.format('YYYY-MM-DD'));
    }

    isDayBlocked(day) {
        return this.state.unavailableDates.includes(day.format('YYYY-MM-DD'));
    }

    render() {
        const { className, focusedInput, startDate, endDate, displayFormat, numberOfMonths, withPortal, checkinUnavailable, checkoutUnavailable, enableOutsideDays, minimumNights } = this.state;
        return (
            <div>
            <Q4DateRangePicker
            {...this.props}
            className={className}
            onDatesChange={this.onDatesChange}
            onFocusChange={this.onFocusChange}
            focusedInput={focusedInput}
            startDate={startDate}
            endDate={endDate}
            displayFormat={displayFormat}
            numberOfMonths={numberOfMonths}
            withPortal={withPortal}
            isDayBlocked={this.isDayBlocked}
            isCheckinUnavailable={this.isCheckinUnavailable}
            isCheckoutUnavailable={this.isCheckoutUnavailable}
            minimumNights={minimumNights}
            />
            </div>
        );
    }
}

export default DateRangePickerWrapper;

ReactDOM.render(
    <DateRangePickerWrapper />, document.getElementById('dates')
);
