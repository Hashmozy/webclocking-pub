import React from "react";
import { Inertia } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/inertia-react";

const Clockings = () => {
    const { clockings } = usePage().props;

    const handleClockIn = () => {
        Inertia.post(route("clockings.clockin"));
    };

    const handleClockOut = () => {
        Inertia.post(route("clockings.clockout"));
    };

    return (
        <div>
            <h1>Clocking System</h1>
            <button onClick={handleClockIn}>Clock In</button>
            <button onClick={handleClockOut}>Clock Out</button>
            <ul>
                {clockings.map((clocking) => (
                    <li key={clocking.id}>
                        Clock In: {clocking.clock_in} - Clock Out:{" "}
                        {clocking.clock_out || "Still Clocked In"}
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default Clockings;
